FROM php:8.2-fpm

RUN apt update && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip librdkafka-dev
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && install-php-extensions amqp rdkafka decimal opcache pdo_pgsql pdo_mysql pcntl sockets redis mysqli bcmath intl zip

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /app