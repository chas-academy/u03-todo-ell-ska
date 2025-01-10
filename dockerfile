FROM php:8.3.14-apache

# update and install required packages
RUN apt-get update && apt-get install -y \
    zip \
    unzip
    
# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# make composer avaliable on path
ENV PATH="/root/.composer/vendor/bin:${PATH}"

# globally install phpcs
RUN composer global require squizlabs/php_codesniffer
# set the coding standard to psr-12
RUN phpcs --config-set default_standard PSR12

# install database extensions
RUN docker-php-ext-install pdo pdo_mysql

# mount the src directory in the container
COPY ./src /var/www/html/

# set the working directory for further commands
WORKDIR /var/www/html

# install application dependencies
RUN composer install --optimize-autoloader