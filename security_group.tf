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

resource "aws_security_group_rule" "tsurins_self_security_group" {
  type              = "ingress"
  from_port         = 0
  to_port           = 0
  protocol          = -1
  self              = true
  security_group_id = aws_security_group.tsurins_security_group.id
}
