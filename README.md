<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Contact List POC

This is a proof of concept that is possible to write a good API with Laravel.

this project is using:
- PHP 8
- Laravel With Sail (https://laravel.com/docs/8.x/sail)
- Vue on Front-end as a single aplication
- Unit test inside Sail module
- Mysql Database
- Redis to handler queues
- Docker to easy deploy on one click

## What this POC is proposed to do?
- Contact list with a CRUD API
- Every thing of the application must have unit test and feature test
- When a contact is deleted, have to send e-mail to a defined and editable e-mail (with laravel´s emails component + queues)
- screen to login and access the contact lists
- Must have a simple permission system to avoid unauthorized or delete any contacts (if user is not a admin)
- Front-end must be usin VueJS

## Requirement
- Docker

## How to run this project
This project is using Sail, so every definition of the project is on docker
- clone the repository ```git clone https://github.com/fbsis/contactPOC-php.git``` and enter on the folder contactPOC-php
- copy the .env (file below) on the root directory
- run command below to install all the dependencies
```
sudo docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```
- run command bellow to give permission ```chmod -R 777 bootstrap/cache storage```
or chmod -R 777 .
- run ``` docker compose up -d```
- migration: ```sudo ./vendor/bin/sail artisan migrate:refresh --seed```
- To stop container: ```sudo ./vendor/bin/sail down```

Everything will be online:
- Laravel with php 8
- Mysql
- Redis
- mailhog (to test email)

To check the email process go to ``http://localhost:8025/`` and see the e-mail when delete contacts

## This is the .env File

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:7MoSsVghRguEycZpP4cFVVdUffCJEAy8jw+J2SW119Y=
APP_DEBUG=true
APP_URL=http://contactPOC-php.test

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=contactpoc_php
DB_USERNAME=sail
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=async
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=memcached

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=poc@teste.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

JWT_SECRET=vPEa3RTJD4yUjsN4o0LMpyvqtku5i27zng5ObM3Oapd8sqldrGM9YsON7Fn9WsMv

APP_URL=http://localhost
```