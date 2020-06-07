resource "aws_ecs_cluster" "tsurins_cluster" {
  name = "tsurins-cluster"
}

resource "aws_launch_configuration" "tsuris_ecs_launch_config" {
  name            = "tsurins_config"
  image_id        = "ami-0f310fced6141e627"
  instance_type   = "t3a.micro"
  security_groups = [aws_security_group.tsurins_security_group.id]
}

resource "aws_autoscaling_group" "tsurins_asg" {
  name                 = "tsurins_autoscaling_group"
  vpc_zone_identifier  = [aws_subnet.tsurins_subnet_1a.id]
  launch_configuration = aws_launch_configuration.tsuris_ecs_launch_config.name

  desired_capacity  = 1
  min_size          = 0
  max_size          = 1
  health_check_type = "EC2"
}
