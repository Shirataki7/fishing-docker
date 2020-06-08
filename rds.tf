resource "aws_db_subnet_group" "tsurins_db_subnets" {
  name       = "tsurins_db"
  subnet_ids = [aws_subnet.tsurins_db_1a.id, aws_subnet.tsurins_db_1c.id]
  tags = {
    Name = "tsurins_db_subnets"
  }
}

resource "aws_db_instance" "tsurins_db" {
  identifier             = "tsurins-production"
  allocated_storage      = 20
  storage_type           = "gp2"
  engine                 = "mysql"
  engine_version         = "5.7"
  instance_class         = "db.t2.micro"
  db_subnet_group_name   = aws_db_subnet_group.tsurins_db_subnets.name
  vpc_security_group_ids = [aws_security_group.tsurins_security_group.id]
  parameter_group_name   = "default.mysql5.7"
  name                   = "tsurins_production"
  port                   = 3306
  username               = data.aws_ssm_parameter.tsurins_db_username.value
  password               = data.aws_ssm_parameter.tsurins_db_password.value
  availability_zone      = "ap-northeast-1a"
}



data "aws_ssm_parameter" "tsurins_db_password" {
  name = "tsurins_db_password"
}

data "aws_ssm_parameter" "tsurins_db_username" {
  name = "tsurins_db_username"
}

