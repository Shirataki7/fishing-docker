#!/bin/sh

AWSID=$(aws sts get-caller-identity | jq -r  .Account)

aws ecr get-login-password --region ap-northeast-1 --profile default | docker login --username AWS --password-stdin 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com

if [$? = 0]; then

#build、タグ付け、push
cd ../
docker build -t tsurins-app:latest -f ./infrastructure/docker/build/Dockerfile .
docker tag tsurins-app:latest 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/tsurins-app:latest
docker push 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/tsurins-app:latest

docker build -t tsurins-nginx:latest -f ./infrastructure/docker/build/nginx/Dockerfile .
docker tag tsurins-nginx:latest 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/tsurins-nginx:latest
docker push 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/tsurins-nginx:latest

#サービスとタスクの作成起動
cd ./laravel
ecs-cli compose --project-name tsurins --file ../ecs/production/app/ecs-compose.yml --ecs-params ../ecs/production/app/ecs-params.yml service up --target-group-arn arn:aws:elasticloadbalancing:ap-northeast-1:872475949043:targetgroup/tsurins-target-group/27aea0e372e2e7c1  --container-name nginx --container-port 80 --health-check-grace-period 120 --create-log-groups

fi
