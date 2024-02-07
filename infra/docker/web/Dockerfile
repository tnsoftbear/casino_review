FROM nginx:latest AS nginx

WORKDIR /workspace

RUN apt-get update && \
    apt-get install -y vim procps lsof && \
    rm -f /etc/nginx/conf.d/default.conf

COPY ./cert/* /etc/nginx/cert/
RUN chmod 400 /etc/nginx/cert/*
COPY ./nginx/* /etc/nginx/
COPY ./conf.d/* /etc/nginx/conf.d/
