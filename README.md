Blaster v2 README.MD

FEATURES
- php 8.1
- laravel 9


INSTALLING:

1.- Clone the project

2.- Change to local project's directory

3.- Install dependencies:

composer install

4.- Create a new file /databases/my_db.sqlite  (or the name that your prefer)

5.- Database access Seetings

copy example.env.example and rename to .env

Configure your databases seetings into file .env

DB_CONNECTION=sqlite

DB_DATABASE=
Maybe you must include the absolute path

6.- Generate de key project:

php artisan key:generate

7.- Migrate and execute the seeders

php artisan migrate --seed

8.- Initialize your local web server

9.- Accessing to Admin Panel:
http://yourdomain/login

user:	  admin@website.com
password: 12345678

You may change your name, email and password in dashboard.

10.- Put Url to front's previews on admin dashboard
(Example: http://yourdomain/)


Note: Maybe you must use http://yourdomain/public instead http://yourdomain/ depending your web server.


Enjoy it!

