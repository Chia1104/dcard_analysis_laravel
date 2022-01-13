FROM php:8.0-fpm
FROM node:alpine
#FROM ubuntu:latest

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo_mysql mbstring

WORKDIR /app
COPY composer.json .
RUN composer install --no-scripts
COPY . .

ENV PATH /app/node_modules/.bin:$PATH
COPY package.json ./
COPY package-lock.json ./
RUN npm install --silent
RUN npm install react-scripts -g --silent
COPY . .

RUN npm run watch

CMD php artisan serve --host=0.0.0.0 --port 80
