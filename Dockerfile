#FROM composer:2.0 as vendor
#
#WORKDIR /app
#
#COPY composer.json composer.lock  ./
#
#RUN composer install --no-scripts

FROM node:lts-alpine as node

WORKDIR /app

COPY . .

RUN npm install \
    && npm run production

FROM php:8.0-fpm-alpine

RUN apk add --no-cache nginx wget

RUN mkdir -p /run/nginx

COPY docker/nginx.conf /etc/nginx/nginx.conf

WORKDIR /var/www
COPY . .
RUN docker-php-ext-install pdo_mysql

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
COPY composer.json composer.lock  ./
RUN composer install --no-scripts
RUN php artisan passport:keys --force

COPY --from=node /app/public public

RUN chown -R www-data: /var/www

CMD ["sh", "/var/www/docker/startup.sh"]

#FROM php:8.0-fpm
#WORKDIR /var/www
#
#RUN docker-php-ext-install pdo_mysql
#RUN apt-get update \
#    && apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file \
#    && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/ \
#    && docker-php-ext-configure gmp \
#    && docker-php-ext-install gmp
#
#RUN apt-get update \
#    && apt-get install -y nginx
#
## 刪除預設的頁面
#RUN rm -rf /var/www/html \
#    && rm /etc/nginx/sites-enabled/default
#
#COPY . .
#COPY docker/nginx.conf /etc/nginx/nginx.conf
#COPY --from=vendor /app/vendor vendor
#COPY --from=node /app/public public
#COPY docker/startup.sh /etc/startup.sh
#
#RUN chown -R www-data: /var/www
#
#EXPOSE 80
#
#CMD ["sh", "/etc/startup.sh"]
