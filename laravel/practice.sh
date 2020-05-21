#!/bin/sh

AWSID=$(aws sts get-caller-identity | jq -r  .Account)

aws ecr get-login-password --region ap-northeast-1 --profile user1 | docker login --username AWS --password-stdin 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/practice-repo

#buildはfishing-dockerディレクトリで

#docker build -t fishing:latest -f ./infrastructure/docker/build/Dockerfile .
#docker tag fishing:latest $AWSID.dkr.ecr.ap-northeast-1.amazonaws.com/fishing:latest
#docker push $AWSID.dkr.ecr.ap-northeast-1.amazonaws.com/fishing:latest
#ecs-cli compose --project-name app --file ../ecs/production/app/ecs-compose.yml --ecs-params ../ecs/production/app/ecs-params.yml service up --create-log-groups

#docker build -t fishing:nginx -f ./infrastructure/docker/build/nginx/Dockerfile .
docker tag fishing:nginx $AWSID.dkr.ecr.ap-northeast-1.amazonaws.com/fishing:nginx
docker push $AWSID.dkr.ecr.ap-northeast-1.amazonaws.com/fishing:nginx
#ecs-cli compose --project-name nginx --file ../ecs/production/nginx/ecs-compose.yml --ecs-params ../ecs/production/nginx/ecs-params.yml service up --create-log-groups