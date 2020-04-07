# School Management System
## Introduction
Application of school management system created by HTML5, CSS3, PHP Framework Laravel and MySQL database. 

## Setup
First install [XAMPP](https://www.apachefriends.org/pl/index.html) (for local database and Apache server) and [Composer](https://getcomposer.org/) (PHP dependency manager). Then use following command:
```shell
composer global require laravel/installer
```
Move project directory to xampp\htdocs or just clone it there using:
```shell
git clone https://github.com/kswiatly/school-management-system.git
```
Go directly to the project directory and install composer and npm dependencies:
```shell
cd school-management-system
composer install
npm install
```
Then copy .env file and generate an app encryption key:
```shell
cp .env.example .env # for Linux
copy .env.example .env # for Windows
php artisan key:generate
```
Create database named <b>school</b> in MySQL using XAMPP (phpMyAdmin) and also change variables in .env file:
```shell
APP_NAME="School Management System"
DB_DATABASE=school
```
and other parameters like DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME or DB_PASSWORD if your database configuration requires it. Finally migrate and seed database using:
```shell
php artisan migrate
php artisan db:seed
```
To run application just type:
```shell
php artisan serve
```
## Basic accounts (available after seed operation)
|       E-mail       |     Password     |  Account type |
|       :---:        |       :---:      |     :---:     |
| admin@school.com   |  admin_password  |     admin     |
| teacher@school.com | teacher_password |    teacher    |
| student@school.com | student_password |    student    |





