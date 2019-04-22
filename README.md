# Setup: Lumen + Lighthouse + Passport

This repository is just a fast forward setup and initial configurations to make Lumen works out of the box with GraphQL with Lighthouse  and secured by Laravel Passport.

## Read more:
* [Lumen](https://lumen.laravel.com/docs/5.8) 
* [Lighthouse](https://lighthouse-php.com/3.3/getting-started/installation.html)
* [Passport](https://laravel.com/docs/5.8/passport)

## Install:
Clone this repo and enter directory:
	
    git clone https://github.com/estudiogenius/lumen-lighthouse-passport.git
    cd lumen-lighthouse-passport

Install composer dependencies and copy .env file from example:

    composer install
    cp .env.example .env

Paste a random 32 string in your APP_KEY in the **.env** file:

    php -r "require 'vendor/autoload.php'; echo str_random(32);"

Also dont forget to set your database in the **.env** file:

    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE= . . .  
    DB_USERNAME= . . .  
    DB_PASSWORD= . . .

Finally... run migration and generate passport keys:

    php artisan migrate
    php artisan passport:install

## Rising the GraphQL server:

After installation completed, you can just serve the GraphQL server with:

    php -S 0.0.0.0:8000 -t public/
