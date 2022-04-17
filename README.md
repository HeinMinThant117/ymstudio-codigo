## Installation Instructions
After cloning the project, install composer dependencies.
```composer install```
Install the npm dependencies
```npm install```
Copy the .env.example file
```cp .env.example .env```
Generate app encryption key
```php artisan key:generate```
Run the database migrations
```php artisan migrate```
You also need to install Laravel passport for the authentication to work
```php artisan passport:install```
You can also run a database seed if you want some ready made data
```php artisan db:seed```## Installation Instructioons

