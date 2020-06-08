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

