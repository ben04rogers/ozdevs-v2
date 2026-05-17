output "ec2_public_ip" {
  description = "Public IP address of the EC2 instance"
  value       = aws_instance.web.public_ip
}

output "rds_endpoint" {
  description = "RDS database endpoint"
  value       = aws_db_instance.main.address
}

output "rds_port" {
  description = "RDS database port"
  value       = aws_db_instance.main.port
}

output "ssh_command" {
  description = "Command to SSH into the instance"
  value       = "ssh -i ${var.key_name}.pem ubuntu@${aws_instance.web.public_ip}"
}
