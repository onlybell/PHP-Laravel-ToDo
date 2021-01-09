# To Do List - Laravel + Vue
## Purpose
Basic todo list, that allows users to register, log in, and create tasks that are saved against their account. 

## Basic Features
- Laravel 8.20.1
- Vue.js 2.6.12
- Chart.js
- MySql

## Installation Steps

**Run composer install**
```
composer install
```
**Create .env**
```
cp .env.example .env
```
**Generate APP_KEY**
```
php artisan key:generate
```
**Passport**
```
php artisan passport:install
```
**Configure MySQL connection details in .env**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={database name}
DB_USERNAME={database user}
DB_PASSWORD={database password}
```
**Run database migrations and seeders**
```
php artisan migrate
```
**Run npm install**
```
npm install
```
**Compile the js and sass code**
```
npm run dev
```
**Once everything is done, start a development server**
```bash
php artisan serve
```
- Then go to `http://localhost:8000` from your browser and see the app.


## PHPUnit Test
To run the unit test, go to the project root and run
```
./vendor/bin/phpunit --testsuite Feature Tests
```
## Preview
- Login
![Login Page](/screen/img_login.png)
- Register
![Register Page](/screen/img_user_register.png)
- Dashboard
![Dashboard Page](/screen/img_dashboard.png)
- To Do List
![List Page](/screen/img_list.png)
- Task Create
![Create Page](/screen/img_create.png)
- Task Edit
![Edit Page](/screen/img_edit.png)
- Task Delete
![Delete Page](/screen/img_delete.png)
- Complete
![Complete Page](/screen/img_complete.png)
