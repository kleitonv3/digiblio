# Digiblio
A simple system to manage a library.

This is the prototype of a university project from the course of Project of Software Systems.


## Attention:
This repository uses Laravel Nova and thus you need a license to install the package. The key must allow the install of the version 4.23.0.

## Technologies needed:
- Composer
- PHP (at least 8.2)
- MySQL

## How to install:
Clone the repository.

Copy the contents of the `.env.example`, create a file named `.env` into the project root folder. In this new file you should firstly add the Laravel Nova license key and change the database variables based on your enviroment. Finally save the file.

Then execute the following commands on the terminal  inside the project folder.
- `composer install`
- `php artisan nova:install`
- `php artisan migrate`

For the purpose of studies, a part of the database schemas were made from scratch using SQL. You can execute the scripts from `digiblio_db.sql` inside the database created for the project.

Have your database up and running and use the command `php artisan serve` to run the project.

If nothing goes wrong you should be able to acess the project from your localhost.

Create an admin user to use the aplication:
- `php artisan nova:user`

Finally, access the {you_localhost}/nova page to make login.
