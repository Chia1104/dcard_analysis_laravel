# 使用 Composer 映像檔下載依賴套件
FROM composer:2.0 as vendor

WORKDIR /app

COPY composer.json composer.lock  ./

# 下載依賴套件並更新
RUN composer install --no-scripts

# 使用 Node 映像檔下載依賴套件
FROM node:lts-alpine as node

WORKDIR /app

# 必須全部複製，否則 Mix 生成的靜態資源檔會找不到對應的輸出路徑
COPY . .

# 下載依賴套件並執行編譯
RUN npm install \
    && npm run production

# 使用 PHP-FPM 映像檔當作環境
FROM php:8.0-fpm

WORKDIR /var/www

# 安裝需要的 PHP 擴展
RUN docker-php-ext-install pdo_mysql
RUN apt-get update \
    && apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file \
    && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/ \
    && docker-php-ext-configure gmp \
    && docker-php-ext-install gmp

# 直接將 Nginx 安裝在環境裡
RUN apt-get update \
    && apt-get install -y nginx

# 刪除預設的頁面
RUN rm -rf /var/www/html \
    && rm /etc/nginx/sites-enabled/default

# 複製所有檔案到環境
COPY . .
# 複製 Nginx 設定檔
COPY docker/nginx/conf.d /etc/nginx/conf.d
# 複製依賴套件
COPY --from=vendor /app/vendor vendor
# 複製靜態檔案
COPY --from=node /app/public public
# 複製啟動腳本
COPY docker/entrypoint.sh /etc/entrypoint.sh

# 設定權限
RUN chown -R www-data:www-data \
    /var/www/storage \
    /var/www/bootstrap/cache

# 暴露 80 埠號
EXPOSE 80

# 執行啟動腳本
ENTRYPOINT ["sh", "/etc/entrypoint.sh"]
