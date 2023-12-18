<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## About Bicase

This project is used as currency converter.It includes register, login and convert services.

### System Req:
- Php 8.1/ 8.2
- MySQL
- Composer 2.x

## How to install

1. Clone project
2. Install Composer

        composer install
3. Copy `.env.example` and set values
4. Create Laravel key

        php artisan key:generate
5. Run migration

        php artisan migrate
6. Serve Project

        php artisan serve
7. There is more than one way to update service data. We used a standard structure that is not subject to limits. Send the following code to your server administrator and ask him to add it to the crontab service.The system will be updated every 15 minutes.

        */15 * * * * cd /var/www/project-directory && php artisan converter:sync >> /dev/null 2>&1


### Run the setup update manually

        php artisan converter:sync


### How to use API

Postman API file has been added so that you can easily access and test the API document. I hope you enjoy using it.

https://documenter.getpostman.com/view/4871431/2s9Ykn9hDq
