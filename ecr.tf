resource "aws_ecr_repository" "tsurins_ecr_app" {
  name = "tsurins-app"
}

resource "aws_ecr_repository" "tsurins_ecr_nginx" {
  name = "tsurins-nginx"
}
