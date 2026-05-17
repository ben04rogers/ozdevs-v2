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
git clone ${github_repo} /var/www/ozdevs/current

# Setup .env
cd /var/www/ozdevs/current
cp .env.example .env

# Configure database connection
sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=mysql/' .env
sed -i 's/DB_HOST=127.0.0.1/DB_HOST=${db_host}/' .env
sed -i 's/DB_DATABASE=laravel/DB_DATABASE=${db_name}/' .env
sed -i 's/DB_USERNAME=root/DB_USERNAME=${db_username}/' .env
sed -i 's/DB_PASSWORD=/DB_PASSWORD=${db_password}/' .env

# Configure S3 for image uploads
sed -i 's|AWS_BUCKET=|AWS_BUCKET=${s3_bucket}|' .env
sed -i 's|AWS_DEFAULT_REGION=us-east-1|AWS_DEFAULT_REGION=${aws_region}|' .env
# Remove AWS keys so SDK uses instance profile instead
sed -i '/^AWS_ACCESS_KEY_ID=/d' .env
sed -i '/^AWS_SECRET_ACCESS_KEY=/d' .env

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
