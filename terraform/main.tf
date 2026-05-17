terraform {
  required_version = ">= 1.0"

  backend "local" {
    path = "terraform.tfstate"
  }
}

resource "aws_vpc" "main" {
  cidr_block           = "10.0.0.0/16"
  enable_dns_hostnames = true
  enable_dns_support   = true

  tags = {
    Name = "ozdevs-vpc"
  }
}

resource "aws_subnet" "public" {
  vpc_id                  = aws_vpc.main.id
  cidr_block              = "10.0.0.0/24"
  availability_zone       = "ap-southeast-2a"
  map_public_ip_on_launch = true

  tags = {
    Name = "ozdevs-public-subnet-a"
  }
}

resource "aws_subnet" "public_b" {
  vpc_id                  = aws_vpc.main.id
  cidr_block              = "10.0.1.0/24"
  availability_zone       = "ap-southeast-2b"
  map_public_ip_on_launch = true

  tags = {
    Name = "ozdevs-public-subnet-b"
  }
}

resource "aws_internet_gateway" "main" {
  vpc_id = aws_vpc.main.id

  tags = {
    Name = "ozdevs-igw"
  }
}

resource "aws_route_table" "public" {
  vpc_id = aws_vpc.main.id

  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.main.id
  }

  tags = {
    Name = "ozdevs-public-rt"
  }
}

resource "aws_route_table_association" "public" {
  subnet_id      = aws_subnet.public.id
  route_table_id = aws_route_table.public.id
}

resource "aws_security_group" "web" {
  name        = "ozdevs-web-sg"
  description = "Security group for web server"
  vpc_id      = aws_vpc.main.id

  ingress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    from_port   = 443
    to_port     = 443
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }

  tags = {
    Name = "ozdevs-web-sg"
  }
}

resource "aws_security_group" "rds" {
  name        = "ozdevs-rds-sg"
  description = "Security group for RDS"
  vpc_id      = aws_vpc.main.id

  ingress {
    from_port       = 3306
    to_port         = 3306
    protocol        = "tcp"
    security_groups = [aws_security_group.web.id]
  }

  tags = {
    Name = "ozdevs-rds-sg"
  }
}

resource "aws_db_subnet_group" "main" {
  name       = "ozdevs-db-subnet-group"
  subnet_ids = [aws_subnet.public.id, aws_subnet.public_b.id]

  tags = {
    Name = "ozdevs-db-subnet-group"
  }
}

resource "aws_db_instance" "main" {
  identifier     = "ozdevs-db"
  engine         = "mysql"
  engine_version = "8.0"
  instance_class = "db.t3.micro"

  allocated_storage     = 20
  max_allocated_storage = 100
  storage_encrypted     = false

  db_name  = var.db_name
  username = var.db_username
  password = var.db_password

  db_subnet_group_name   = aws_db_subnet_group.main.id
  vpc_security_group_ids = [aws_security_group.rds.id]

  skip_final_snapshot     = true
  deletion_protection     = false
  backup_retention_period = 0

  tags = {
    Name = "ozdevs-db"
  }
}

resource "aws_instance" "web" {
  ami           = "ami-09a977aafd83c55e7" # Ubuntu Server 24.04 LTS in ap-southeast-2
  instance_type = "t3.micro"
  subnet_id     = aws_subnet.public.id

  key_name = var.key_name

  vpc_security_group_ids = [aws_security_group.web.id]

  associate_public_ip_address = true

  user_data = <<-EOF
              #!/bin/bash
              set -e

              export DEBIAN_FRONTEND=noninteractive
              export HOME=/root

              # Update and install required packages
              apt-get update
              apt-get install -y software-properties-common
              add-apt-repository -y ppa:ondrej/php
              apt-get update
              apt-get install -y php8.3 php8.3-fpm php8.3-mysql php8.3-curl php8.3-gd php8.3-mbstring php8.3-xml php8.3-bcmath php8.3-intl unzip nginx mysql-client git composer

              # Install Node.js 20
              curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
              apt-get install -y nodejs

              # Create deployment directory
              mkdir -p /var/www/ozdevs
              cd /var/www/ozdevs

              # Clone repository
              git clone ${var.github_repo} /var/www/ozdevs/current

              # Setup .env
              cd /var/www/ozdevs/current
              cp .env.example .env

              # Configure database connection
              sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=mysql/' .env
              sed -i 's/DB_HOST=127.0.0.1/DB_HOST=${aws_db_instance.main.address}/' .env
              sed -i 's/DB_DATABASE=laravel/DB_DATABASE=${var.db_name}/' .env
              sed -i 's/DB_USERNAME=root/DB_USERNAME=${var.db_username}/' .env
              sed -i 's/DB_PASSWORD=/DB_PASSWORD=${var.db_password}/' .env

              # Install dependencies
              export HOME=/root
              COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --optimize-autoloader
              npm install --legacy-peer-deps

              # Generate app key
              php artisan key:generate

              # Build assets
              npm run build

              # Run migrations
              php artisan migrate --force

              # Seed database
              php artisan db:seed --force

              # Set permissions
              chmod -R 755 /var/www/ozdevs/current
              chmod -R 775 /var/www/ozdevs/current/storage
              chown -R www-data:www-data /var/www/ozdevs/current

              # Configure Nginx
              cat > /etc/nginx/sites-available/ozdevs << 'NGINX'
              server {
                  listen 80;
                  server_name _;
                  root /var/www/ozdevs/current/public;
                  index index.php index.html;

                  location / {
                      try_files $uri $uri/ /index.php?$query_string;
                  }

                  location ~ \.php$ {
                      include snippets/fastcgi-php.conf;
                      fastcgi_pass unix:/run/php/php8.3-fpm.sock;
                      fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                      include fastcgi_params;
                  }

                  location ~ /\.(?!well-known).* {
                      deny all;
                  }
              }
              NGINX

              rm -f /etc/nginx/sites-enabled/default
              ln -s /etc/nginx/sites-available/ozdevs /etc/nginx/sites-enabled/

              # Restart services
              systemctl restart php8.3-fpm
              systemctl restart nginx

              # Install and configure Fail2Ban (optional, for basic security)
              apt-get install -y fail2ban

              EOF

  tags = {
    Name = "ozdevs-web"
  }
}

resource "aws_eip" "web" {
  instance = aws_instance.web.id
  domain   = "vpc"

  tags = {
    Name = "ozdevs-eip"
  }
}
