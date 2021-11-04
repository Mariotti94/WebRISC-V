FROM php:8.0-apache

RUN apt-get update && \
    apt-get -y install libgmp-dev && \ 
    docker-php-ext-install gmp
