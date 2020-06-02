#!/bin/sh

AWSID=$(aws sts get-caller-identity | jq -r  .Account)

aws ecr get-login-password --region ap-northeast-1 --profile default | docker login --username AWS --password-stdin 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com

#build、タグ付け、push
cd ../
docker build -t fishing:latest -f ./infrastructure/docker/build/Dockerfile .
docker tag fishing-app:latest 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/fishing-app:latest
docker push 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/fishing:latest

docker build -t fishing:nginx -f ./infrastructure/docker/build/nginx/Dockerfile .
docker tag fishing-nginx:latest 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/fishing-nginx:latest
docker push 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/fishing:nginx

#サービスとタスクの作成起動
cd ./laravel
ecs-cli compose --project-name app --file ../ecs/production/app/ecs-compose.yml --ecs-params ../ecs/production/app/ecs-params.yml service up --target-group-arn arn:aws:elasticloadbalancing:ap-northeast-1:872475949043:targetgroup/fishing-target-group/2b4999b192b9099c  --container-name nginx --container-port 80 --health-check-grace-period 120 --create-log-groups
