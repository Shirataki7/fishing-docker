resource "aws_lb" "tsurins_alb" {
  name               = "tsurins-alb"
  load_balancer_type = "application"
  security_groups    = [aws_security_group.tsurins_security_group.id]
  subnets            = ["aws_subnet.tsurins_subnet_1a.id","aws_subnet.tsurins_subnet_1c.id"]
}

resource "aws_alb_target_group" "tsurins_target_group" {
  name     = "tsurins-target-group"
  port     = 80
  protocol = "HTTP"
  vpc_id   = aws_vpc.tsurins_vpc.id

  health_check {
    interval            = 30
    path                = "/"
    port                = 80
    protocol            = "HTTP"
    timeout             = 5
    unhealthy_threshold = 2
    matcher             = 200
  }
}

resource "aws_lb_listener" "tsurins_alb_listener"{
    load_balancer_arn=aws_lb.tsurins_alb.arn
    port=80
    protocol="HTTP"

    default_action{
        type="forward"
        target_group_arn=aws_alb_target_group.tsurins_target_group.arn
    }

}

