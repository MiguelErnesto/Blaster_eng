Blaster v2 README.MD

FEATURES
- php 8.2
- laravel 9
- mysql (MariaDB local via Docker; Railway MySQL in production)


INSTALLING:

1.- Clone the project

2.- Change to local project's directory

3.- Install dependencies:

composer install --ignore-platform-reqs

4.- Start local MariaDB (port 3308; 3306/3307 already in use):

docker compose up -d

5.- Database settings

copy .env.example and rename to .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=blaster
DB_USERNAME=root
DB_PASSWORD=secret

6.- Generate de key project:

php artisan key:generate

7.- Migrate and execute the seeders

php artisan migrate --seed

8.- Initialize your local web server

9.- Accessing to Admin Panel:
http://yourdomain/login
http://yourdomain/admin

user:	  admin@website.com
password: 12345678

You may change your name, email and password in dashboard.

10.- Put Url to front's previews on admin dashboard
(Example: http://yourdomain/)


Note: Maybe you must use http://yourdomain/public instead http://yourdomain/ depending your web server.

Deploy: see docs/RAILWAY.md


Enjoy it!
