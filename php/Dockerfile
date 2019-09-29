FROM php:5.6-apache-jessie
MAINTAINER Shashikant Bangera @shzshi

COPY php.ini /usr/local/etc/php/
RUN apt-get update \
  && apt-get install -y libfreetype6-dev apt-utils libjpeg62-turbo-dev libpng-dev libmcrypt-dev \
  && docker-php-ext-install pdo_mysql mysqli gd iconv 
COPY ./myenvironmentbookingtool.com.conf  /etc/apache2/sites-available/
COPY ./hosts  /etc/hosts

RUN a2enmod rewrite 

RUN service apache2 restart
WORKDIR /etc/apache2/sites-available/
RUN a2ensite myenvironmentbookingtool.com.conf 


