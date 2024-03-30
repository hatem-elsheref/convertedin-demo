
## How To Run Project

- If environment is compatable with the requirements run the following commands:
#### `` fill .env file with the right database connections details ``
#### `` composer install``
#### `` php artisan migrate:fresh --seed``
#### `` php artisan serve``
#### `` open your browser `` [Open Project](http://127.0.0.1:8000/login)

- If you want to run in docker follow this steps:
#### `` Move Project data in <core> dir  ``
#### `` run docker-compose build``
#### `` run docker-compose up``
#### `` fill .env file with the right database connections details ``
```
DB_CONNECTION=mysql
DB_HOST=converted_in_db_server
DB_PORT=3306
DB_DATABASE=converted_in
DB_USERNAME=admin
DB_PASSWORD=secret
```
- Don't forget to make cron job to run  ``` php artisan schedule:run ``` to run needed commands
- Don't forget to run ``` php artisan queue:work ``` to update statistics

#### `` Open Webserver Container And Run ``

```
php artisan migrate:fresh --seed
ap2enmod rewrite
service apache2 start
```
`` open your browser `` [Open Project](http://127.0.0.1:8008/public/login)


## Project TimeLine
- `` Project Installation && Migrations && Models && Seeders && Factories``  : ``1:30 Hours``
- `` Routes && Middlewares && Controllers && Services``  : ``1 Hour``
- `` Html Pages && Datatables && Select 2``  : ``2 Hours``
- `` UnitTesting && Github Actions``  : ``2 Hours``
- `` Docker And Prepare Environment`` : ``3 Hours``
- All About  ``8 - 9 Hours``



## Admin Credentials
- Email: ``a.ramadan@converted.in``
- Password: ``12345678``

## User Credentials
- Email: ``user_1@converted.in``
- Password: ``12345678``
