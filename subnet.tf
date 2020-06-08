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
