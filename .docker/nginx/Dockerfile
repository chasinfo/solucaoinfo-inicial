FROM nginx:1.17.8-alpine

RUN apk add --no-cache openssl bash

WORKDIR /var/www

RUN rm /etc/nginx/conf.d/default.conf
COPY ./nginx.conf /etc/nginx/conf.d
