resource "aws_vpc" "tsurins_vpc" {
  cidr_block       = "10.0.0.0/16"
  instance_tenancy = "default"
  tags = {
    Name = "tsurins"
  }
}

resource "aws_subnet" "tsurins_subnet_1a" {
  cidr_block        = "10.0.0.0/24"
  availability_zone = "ap-northeast-1a"
  vpc_id            = aws_vpc.tsurins_vpc.id
  tags = {
    Name = "tsurins_1a"
  }
}

resource "aws_subnet" "tsurins_subnet_1c" {
  cidr_block        = "10.0.1.0/24"
  availability_zone = "ap-northeast-1c"
  vpc_id            = aws_vpc.tsurins_vpc.id
  tags = {
    Name = "tsurins_1c"
  }
}

resource "aws_subnet" "tsurins_db_1a" {
  cidr_block        = "10.0.2.0/24"
  availability_zone = "ap-northeast-1a"
  vpc_id            = aws_vpc.tsurins_vpc.id
  tags = {
    Name = "tsurins_db_1a"
  }
}

resource "aws_subnet" "tsurins_db_1c" {
  cidr_block        = "10.0.3.0/24"
  availability_zone = "ap-northeast-1c"
  vpc_id            = aws_vpc.tsurins_vpc.id
  tags = {
    Name = "tsurins_db_1c"
  }
}

resource "aws_internet_gateway" "tsurins_gateway" {
  vpc_id = aws_vpc.tsurins_vpc.id
  tags = {
    Name = "tsurins_gateway"
  }
}

resource "aws_route_table" "tsurins_public_route_table" {
  vpc_id = aws_vpc.tsurins_vpc.id
  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.tsurins_gateway.id
  }
  tags = {
    Name = "tsurins_public_route_table"
  }
}

resource "aws_route_table" "tsurins_db_route_table" {
  vpc_id = aws_vpc.tsurins_vpc.id
  tags = {
    Name = "tsurins_db_route_table"
  }
}

#パブリックサブネットをルートテーブルに紐づける
resource "aws_route_table_association" "tsurins_subnet_1a_route" {
  subnet_id      = aws_subnet.tsurins_subnet_1a.id
  route_table_id = aws_route_table.tsurins_public_route_table.id
}

resource "aws_route_table_association" "tsurins_subnet_1c_route" {
  subnet_id      = aws_subnet.tsurins_subnet_1c.id
  route_table_id = aws_route_table.tsurins_public_route_table.id
}

#プライベートサブネットをルートテーブルに紐付ける
resource "aws_route_table_association" "tsurins_db_subnet_1a_route" {
  subnet_id      = aws_subnet.tsurins_db_1a.id
  route_table_id = aws_route_table.tsurins_db_route_table.id
}

resource "aws_route_table_association" "tsurins_db_subnet_1c_route" {
  subnet_id      = aws_subnet.tsurins_db_1c.id
  route_table_id = aws_route_table.tsurins_db_route_table.id
}

resource "aws_security_group" "tsurins_security_group" {
  name        = "tsurins"
  vpc_id      = aws_vpc.tsurins_vpc.id
  description = "tsurints_security_group"
  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }
}
resource "aws_security_group_rule" "tsurins_db_security_group" {
  type              = "ingress"
  from_port         = 3306
  to_port           = 3306
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.tsurins_security_group.id
}

resource "aws_security_group_rule" "tsurins_alb_security_group" {
  type              = "ingress"
  from_port         = 32768
  to_port           = 61000
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.tsurins_security_group.id
}

resource "aws_security_group_rule" "tsurins_ssh_security_group" {
  type              = "ingress"
  from_port         = 22
  to_port           = 22
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
  security_group_id = aws_security_group.tsurins_security_group.id
}

resource "aws_security_group_rule" "tsurins_self_security_group" {
  type              = "ingress"
  from_port         = 0
  to_port           = 0
  protocol          = -1
  self              = true
  security_group_id = aws_security_group.tsurins_security_group.id
}
