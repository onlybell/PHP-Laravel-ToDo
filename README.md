# ToDo List (with Burndown Chart) - Laravel, Vue.js & Chart.js
Basic todo list, that allows users to register, log in, and create tasks that are saved against their account. It includes the dynamic burndown chart, that displays the number of tasks that were not yet completed at each minute in the last hour.
## Installation Steps
**Clone the repo**
```
https://github.com/kevinreynolds/todolist.git codechallenge && cd codechallenge
```
**Run composer install**
```
composer install
```
**Run npm install**
(node - v6.10.0 and npm - v3.10.10)
```
npm install
```
**Create .env**
```
cp .env.example .env
```
**Generate APP_KEY**
```
php artisan key:generate
```
**Setup Timezone in .env**
```
APP_TZ=Pacific/Auckland
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
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```
## Running the application
Run the application in a **Virtual Host**

#### Comes with couple of default users
User credentials are as follows
```
1. Email: anakin@starwars.com | Password: secret
2. Email: luke@starwars.com | Password: secret
```
## PHPUnit Test
To run the unit test, go to the project root and run
```
phpunit
```
