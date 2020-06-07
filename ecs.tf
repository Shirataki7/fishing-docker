resource "aws_ecs_cluster" "tsurins_cluster" {
  name = "tsurins-cluster"
}

resource "aws_launch_configuration" "tsuris_ecs_launch_config" {
  name            = "tsurins_config"
  image_id        = "ami-0f310fced6141e627"
  instance_type   = "t3a.micro"
  security_groups = [aws_security_group.tsurins_security_group.id]
}
