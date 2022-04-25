# Comment System

A system where you can add and reply to a comment.

## Requirement
1. docker
2. composer
3. node

## Instruction

1. Clone this repository
2. Build docker image.
```docker compose build```
3. Install packages
```composer install```
```npm install```
4. Go to php container. ```docker-compose exec php /bin/sh```
    1. ```chmod -R 777 ./storage```
    2. ```php artisan key:generate```
    3. ```php artisan migrate```
5. Compile
```npm run dev```
6. Go to your web browser and type localhost:8080