FROM nginx:1.25

COPY ./log.conf /etc/logrotate.d/nginx
COPY ./default.conf /etc/nginx/conf.d/default.conf

RUN apt-get update && apt-get install -y openssl ca-certificates

COPY server.crt /etc/nginx/certs/server.crt
COPY server.key /etc/nginx/certs/server.key
