resource "aws_vpc" "tsurins_vpc" {
  cidr_block       = "10.0.0.0/16"
  instance_tenancy = "default"
  tags = {
    Name = "tsurins"
  }
}

resource "aws_internet_gateway" "tsurins_gateway" {
  vpc_id = aws_vpc.tsurins_vpc.id
  tags = {
    Name = "tsurins_gateway"
  }
}

