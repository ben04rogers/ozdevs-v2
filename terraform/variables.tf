variable "key_name" {
  description = "EC2 Key Pair name"
  type        = string
  default     = "ozdevs-key"
}

variable "github_repo" {
  description = "GitHub repository URL"
  type        = string
  default     = "https://github.com/ben04rogers/ozdevs-v2"
}

variable "db_name" {
  description = "RDS database name"
  type        = string
  default     = "ozdevs"
}

variable "db_username" {
  description = "RDS master username"
  type        = string
  default     = "admin"
}

variable "db_password" {
  description = "RDS master password"
  type        = string
  sensitive   = true
}
