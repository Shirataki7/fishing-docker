FROM node:14.2-alpine as node
FROM nginx:1.17-alpine
SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

ENV TZ=Asia/Tokyo

RUN apk update && \
  apk add --update --no-cache --virtual=.build-dependencies g++

COPY --from=node /usr/local/bin /usr/local/bin
COPY --from=node /opt /opt
COPY ./infrastructure/docker/nginx/default.conf /etc/nginx/conf.d/default.conf

COPY ./laravel /work/laravel

COPY ./laravel/php-fpm /var/run/php-fpm
COPY ./laravel/php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf

WORKDIR /work/laravel