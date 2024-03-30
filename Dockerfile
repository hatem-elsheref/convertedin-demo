FROM php:8.1-apache

COPY core /var/www/html/

WORKDIR /var/www/html

RUN apt-get update
RUN apt-get upgrade
RUN apt-get install -y curl
RUN apt-get install -y libpng-dev
RUN apt-get install -y libxml2-dev
RUN apt-get install -y zip
RUN apt-get install -y unzip
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
#RUN apt-get install -y git
RUN apt-get install -y bash
#RUN apt-get install -y nodejs
#RUN apt-get install -y npm
RUN apt-get install -y util-linux

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install --ignore-platform-req=ext-zip --ignore-platform-req=ext-gd

RUN  chmod 777 -R storage
