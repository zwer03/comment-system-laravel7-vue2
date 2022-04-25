# Comment System

A system where you can add and reply to a comment.

## Requirement
1. docker
2. composer
3. node

## Instruction

1. Clone this repository
2. Rename .env.example to .env
3. Update env file
    1. ```DB_HOST=mysql```
    2. ```DB_USERNAME=user```
    3. ```DB_PASSWORD=secret```
    4. Add ```L5_SWAGGER_CONST_HOST=http://localhost:8080/api```
4. Build docker image.
```docker compose build```
5. Install packages
```composer install```
```npm install```
6. Go to php container. ```docker-compose exec php /bin/sh```
    1. ```chmod -R 777 ./storage```
    2. ```php artisan key:generate```
    3. ```php artisan migrate```
7. Compile
```npm run dev```
8. [Click here to access](http://localhost:8080)
7. [API docs](http://localhost:8080/api/documentation)