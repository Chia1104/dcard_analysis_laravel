# Dcard Analysis Laravel, Rest API

The app is a simple web app that uses Laravel and Rest API to fetch data from our database(MongoDB).

API V1: It has no longer supported.

API V2: [API Documentation](https://dcard-analysis-laravel-fdqsyjapma-de.a.run.app/api/documentation).

## Get Started
Generate .env file:
```
$ cp .env.example .env
$ php artisan key:generate
```
Install dependencies:
```
$ composer install
```
Start the server:
```
$ php artisan serve
```
## Docker
Run the server in Docker:
```
$ docker build -t app:v2 .
$ docker run -e PORT=80 -p 80:80 app:v2
```

## Features
- [X] Rest API
- [X] Cloud Computing
- [X] Nginx
- [ ] Complete API V2
- [ ] React UI
