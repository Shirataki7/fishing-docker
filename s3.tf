provider "aws" {
  region  = "ap-northeast-1"
  profile = "Administrator"
}


terraform {
  required_version = "0.12.26"
  backend "s3" {
    bucket  = "fishing-tfstate"
    region  = "ap-northeast-1"
    profile = "Administrator"
    key     = "terraform.tfstate"
    encrypt = true
  }
}