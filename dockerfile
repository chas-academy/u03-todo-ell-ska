FROM php:8.3.14-apache

# install necessary extensions
RUN docker-php-ext-install pdo pdo_mysql

# install php code sniffer and php code beautifier and fixer
RUN curl -OL https://phars.phpcodesniffer.com/phpcs.phar && \
    curl -OL https://phars.phpcodesniffer.com/phpcbf.phar && \
    chmod +x phpcs.phar phpcbf.phar && \
    mv phpcs.phar /usr/local/bin/phpcs && \
    mv phpcbf.phar /usr/local/bin/phpcbf

# set the coding standard to psr-12
RUN phpcs --config-set default_standard PSR12