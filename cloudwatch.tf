resource "aws_cloudwatch_log_group" "tsurins_app_log_group" {
  name = "ecs/tsurins-app"
}

resource "aws_cloudwatch_log_group" "tsurins_nginx_log_group" {
  name = "ecs/tsurins-nginx"
}
