FROM php:8.0-fpm

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

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash
RUN apt-get install --yes nodejs

WORKDIR /app
COPY composer.json ./
COPY composer.lock ./
RUN composer install --no-scripts
COPY . .

COPY package.json ./
COPY package-lock.json ./
RUN npm install --silent
RUN npm run production
COPY . .

CMD php artisan serve --host=0.0.0.0 --port 80
