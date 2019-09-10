#!/bin/bash

APP=laravel

echo Uploading Application container
docker-compose up -d

echo Copying the configuration example file
cp .env.example app-login/.env

echo Create project
docker exec -it $APP-app composer create-project --prefer-dist laravel/laravel app-login

echo Install dependencies
docker exec -it $APP-app composer install
#echo Update dependencies
#docker exec -it $APP-app composer update

echo Install API Client laravel
#docker exec -it $APP-app composer require guzzlehttp/guzzle:^6.3
#docker exec -it $APP-app php artisan make:json-api external

echo Generate key
docker exec -it $APP-app php artisan key:generate

echo Make migrations
docker exec -it $APP-app php artisan migrate

echo Make seeds
docker exec -it $APP-app php artisan db:seed

echo Information of new containers
docker ps