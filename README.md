## Laravel PHP Framework

Usage: Start by creating the database 

```bash
$ mysql -uroot -p
mysql> CREATE DATABASE laravelatrest;
mysql> quit;
```

PHP Dependencies
```bash
# call in our dependencies
$ composer install
```
.js Helpers
```bash
# nodejs dependencies --save-dev flag installs 
# locally opposed to globally
$ npm install package.json --save-dev
```

using dotenv: to change the database connection parameters
```bash
# show the environmentals
$ php artisan env:list
```

```bash
# Create or edit an entry in your .env file:
$ php artisan env:set {key} {value} [--line-break|-L]
# Add the --line-break (or -L) option to insert a line break before the entry.
```

```bash
# Delete an entry from your .env file:
$ php artisan env:delete {key}
```

```bash
# Show the value of the given key from your .env file:
$ php artisan env:get {key}
```

then run the migraton
```
# migration will create your database and seed the values for you 
$ php artisan migrate:install
```


as I didn't have time to fully integrate artisan commands into the user interface they have not been tested and are definitely
not fully functional, but there is one custom artisan command that can be used to fetch and parse the inital xml needed for this
application to run.

`fetch:listings`

eveything else can be done using the corresponding buttons or using the correct console commands. 

            ~oasisfleeting.




[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
