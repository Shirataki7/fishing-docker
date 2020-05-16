#!/bin/sh

AWSID=$(aws sts get-caller-identity | jq -r  .Account)

aws ecr get-login-password --region ap-northeast-1 --profile user1 | docker login --username AWS --password-stdin 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/practice-repo

docker tag feature/tag:latest $AWSID.dkr.ecr.ap-northeast-1.amazonaws.com/practice-repo:latest

docker push $AWSID.dkr.ecr.ap-northeast-1.amazonaws.com/practice-repo:latest

ecs-cli compose --project-name fishing --file ../ecs/staging/ecs-compose.yml --ecs-params ../ecs/staging/ecs-params.yml service up --create-log-groups