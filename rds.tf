resource "aws_db_subnet_group" "tsurins_db_subnets" {
  name       = "tsurins_db"
  subnet_ids = ["aws_subnet.tsurins_db_1a", "aws_subnet.tsurins_db_1c"]
  tags = {
    Name = "tsurins_db_subnets"
  }
}

resource "aws_db_instance" "tsurins_db" {
  identifier           = "tsurins-production"
  allocated_storage    = 20
  storage_type         = "pg2"
  engine               = "mysql"
  engine_version       = "5.7"
  instance_class       = "db.t2.micro"
  db_subnet_group_name = aws_db_subnet_group.tsurins_db_subnets.name
  parameter_group_name = "default.mysql5.7"
  name                 = "tsurins-production"
  port                 = 3306
  username             = data.aws_ssm_parameter.tsurins_db_username.id
  password             = data.aws_ssm_parameter.tsurins_db_password.id
  timezone             = "Asia/Tokyo"
  availability_zone    = "ap-northeast-1a"
}



data "aws_ssm_parameter" "tsurins_db_password" {
  name = "tsurins_db_password"
}

data "aws_ssm_parameter" "tsurins_db_username" {
  name = "tsurins-db-username"
}
