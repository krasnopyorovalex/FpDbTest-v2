FROM php:cli-alpine3.19
RUN docker-php-ext-install mysqli pdo pdo_mysql