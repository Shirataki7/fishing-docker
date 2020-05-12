DOCKER_TAG="$1"

AWSID=$(aws sts get-caller-identity)

LOGIN=$(aws ecr get-login-password --region ap-northeast-1 --profile user1 | docker login --username AWS --password-stdin 872475949043.dkr.ecr.ap-northeast-1.amazonaws.com/practice-repo)

${LOGIN}

docker tag $DOCKER_TAG:latest $AWSID.dkr.ecr.ap-northeast-1.amazonaws.com/$DOCKER_TAG:latest

docker push $AWSID.dkr.ecr.ap-northeast-1.amazonaws.com/$DOCKER_TAG:latest