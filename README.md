# Contract Generator

## Requirement

- php 8.1
- node 16.x
- mysql 5.7 with database theDatabaseName on localhost and login root, password root
- composer

## How to run

-   copy `env-local` to `.env`
-   create database `theDatabaseName` on localhost mysql server that can be connected using root, root
-   run `yarn`
-   run `yarn start`
-   run `composer install --ignore-platform-reqs`
-   run `php artisan storage:link`
-   run `php artisan migrate:fresh --seed`
-   run `php artisan serve`
