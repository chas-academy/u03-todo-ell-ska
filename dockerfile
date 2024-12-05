FROM php:8.3.14-apache

# install necessary extensions
RUN docker-php-ext-install pdo pdo_mysql
