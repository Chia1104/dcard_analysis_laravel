# Dcard Analysis Laravel, Rest API

Dcard is an anonymous social community website commonly used by university students, where they can post content related to school, coursework, daily life, and more. As a result, the university counseling department hopes that we can crawl Dcard for articles related to Chang Gung University, in order to obtain timely feedback from students regarding their thoughts on the university, or to identify students who may be experiencing emotional difficulties.

Our project uses a Python web scraper to automatically retrieve and store article content into a database, using MySQL Workbench for database management. We then utilize the Snow NLP package to analyze article content and store the results in the database. For the frontend, we chose to develop our app using Android Studio. The system is constantly running a detection program, which will automatically utilize the IFTTT platform to send a warning message to school staff via Line if extreme language is detected in the crawled article content.

Our app primarily uses API connections to set up data and complete main functions, including an article list, charts (pie chart, bar chart, and line chart), and search function. Our backend is developed using PHP with the Laravel framework, and the final project is deployed onto a Cloud Server. We have chosen Google Cloud Platform (GCP) as our cloud provider, and have utilized their Cloud Run service to establish an API.


API V1: It has no longer supported.

API V2: [API Documentation](https://dcard-analysis-laravel-fdqsyjapma-de.a.run.app/api/documentation).

## Languages and Tools

<div align="center">
  <a href="https://www.php.net" target="_blank" rel="noreferrer"> 
    <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40"/> 
  </a>
  <a href="https://laravel.com/" target="_blank" rel="noreferrer"> 
    <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-plain-wordmark.svg" alt="laravel" width="40" height="40"/> 
  </a>
  <a href="https://www.mongodb.com/" target="_blank" rel="noreferrer"> 
    <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mongodb/mongodb-original-wordmark.svg" alt="mongodb" width="40" height="40"/> 
  </a> 
  <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> 
    <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/> 
  </a> 
  <a href="https://www.docker.com/" target="_blank" rel="noreferrer"> 
    <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/docker/docker-original-wordmark.svg" alt="docker" width="40" height="40"/> 
  </a> 
  <a href="https://cloud.google.com" target="_blank" rel="noreferrer"> 
    <img src="https://www.vectorlogo.zone/logos/google_cloud/google_cloud-icon.svg" alt="gcp" width="40" height="40"/> 
  </a> 
  <a href="https://heroku.com" target="_blank" rel="noreferrer"> 
    <img src="https://www.vectorlogo.zone/logos/heroku/heroku-icon.svg" alt="heroku" width="40" height="40"/> 
  </a> 
  <a href="https://www.nginx.com" target="_blank" rel="noreferrer"> 
    <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/nginx/nginx-original.svg" alt="nginx" width="40" height="40"/> 
  </a> 
</div>

## Features
- [X] Rest API
- [X] Cloud Computing
- [X] Nginx
- [ ] Complete API V2
- [ ] React UI

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
