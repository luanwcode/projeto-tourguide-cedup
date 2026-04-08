FROM php:8.3:apache

#Install the necessary extensios for MYSQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

#Enables the rewrite model (useful for .htaccess and frameworks)
RUN a2enmod rewrite

WORKDIR /var/www/html

EXPOSE 80