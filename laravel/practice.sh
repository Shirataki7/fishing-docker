#!/bin/sh

AWSID=$(aws sts get-caller-identity | jq -r  .Account)

aws ecr get-login-password --region ap-northeast-1 --profile user1 | docker login --username AWS --password-stdin 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/practice-repo

docker tag practice-repo:latest $AWSID.dkr.ecr.ap-northeast-1.amazonaws.com/practice-repo:latest

ecs-cli push $AWSID.dkr.ecr.ap-northeast-1.amazonaws.com/practice-repo:latest 

