#!/bin/bash

APP=php-fpm

echo Uploading Application container
docker-compose up -d

echo Copying the configuration example file
cp htdocs/.env.example htdocs/.env
cp htdocs/api.dev/.env.example htdocs/api.dev/.env

echo Install dependencies
docker exec -it $APP-app composer install
docker exec -it $APP-app --bash exec "cd /var/www/html/api.dev && composer install"
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