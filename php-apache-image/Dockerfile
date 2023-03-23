FROM php:8.0.28-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y libpq-dev
# RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN echo "extension=/usr/local/lib/php/extensions/no-debug-non-zts-20200930/pdo_mysql.so" > /usr/local/etc/php/conf.d/mysqli.ini

#COPY php.ini /usr/local/etc/php/
#no-debug-non-zts-20200930