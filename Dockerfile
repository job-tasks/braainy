FROM php:7.4-apache

RUN apt -y update \
  && apt install -y \
  mariadb-client

# pdo_mysql package
RUN docker-php-ext-install pdo pdo_mysql

RUN php -r "copy('https://getcomposer.org/composer.phar', 'composer.phar');" \
  && mv composer.phar /usr/local/bin/composer \
  && chmod +x /usr/local/bin/composer
  
RUN apt update && apt install iputils-ping -y && apt install nano -y 

RUN apt update && apt install git -y

ENV APACHE_DOCUMENT_ROOT=/vaw/www/html/public

WORKDIR /var/www/html

COPY .docker/default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite