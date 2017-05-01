FROM php:7.1-apache

# add web user
RUN useradd -m -s /bin/bash -u 1000 laravel

# install zip
RUN apt-get update
RUN apt-get install -y zlib1g-dev
RUN docker-php-ext-install zip

# install php-mysql
RUN docker-php-ext-install pdo_mysql

# install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# enable mod rewrite
RUN a2enmod rewrite
RUN service apache2 restart
