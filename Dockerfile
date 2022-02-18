FROM node:lts-alpine as node

WORKDIR /app

COPY . .

RUN npm install \
    && npm run production

FROM php:8.0-fpm-alpine

RUN apk --update add --virtual build-dependencies build-base openssl-dev autoconf \
  && pecl install mongodb \
  && docker-php-ext-enable mongodb \
  && apk del build-dependencies build-base openssl-dev autoconf \
  && rm -rf /var/cache/apk/*

RUN apk add --no-cache nginx wget

RUN mkdir -p /run/nginx

COPY docker/nginx.conf /etc/nginx/nginx.conf

WORKDIR /var/www
COPY . .

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
COPY composer.json composer.lock  ./
RUN composer install --no-scripts

COPY docker/Passport/AuthCode.php vendor/laravel/passport/src/AuthCode.php
COPY docker/Passport/Client.php vendor/laravel/passport/src/Client.php
COPY docker/Passport/PersonalAccessClient.php vendor/laravel/passport/src/PersonalAccessClient.php
COPY docker/Passport/Token.php vendor/laravel/passport/src/Token.php
RUN php artisan passport:keys --force

RUN php artisan l5-swagger:generate

COPY --from=node /app/public public

RUN chown -R www-data: /var/www

CMD ["sh", "/var/www/docker/startup.sh"]
