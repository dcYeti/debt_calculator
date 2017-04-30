#The outtadebt Project  (for Laravel documentation read below)

This is a debt repayment calculator that considers multiple lines of credit with different, but fixed interest rates.  <br/>
By using the avalanche method of paying higher-interest balances first, the calculator shows how long it will take to pay down
all debts and how much total interest will be paid.

##Getting Started

This is a PHP 5 application built using the Laravel MVC framework.  You will need to have a laravel installation via Composer.  For more
information on how to configure a Laravel installtion, please see below.

##Prerequisites
PHP installation, MySQL server, Laravel installation, Twitter's Bootstrap, JQuery (included with bootstrap)

##Installation
After download, there are a some adjustments to make.<br/>
1) Configure Twitter Bootstrap.  It is essential to the general look of the calculator.  The current settings are shown below and assume that the laravel installation and bootstrap directory are both in the root directory.  Currently, they are set like this:<br/>
```
  	<link href="{{asset('../../bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"> 	
	<link href="{{asset('../../jumbotron.css')}}" rel="stylesheet" type="text/css">  					
```
For a different location, you will have to change the path on each of the views in the "resources/views/" directory.

2) Enter your database and mail server settings in the db_connect.php located in "app/Includes" directory.  A template is provided, with the user needing to define the database constants.  The calculator uses PHP's mail() function to e-mail users their debt profile once completed. <br/>
```
	//Fill in your MySQL settings 
	DEFINE('DB_USER', 'username');					//MySQL database username	
	DEFINE('DB_PASS', 'password');					//MySQL database password	
	DEFINE('DB_HOST', 'localhost');					//Host - usually this is localhost 
	DEFINE('DB_NAME', 'outtadebtDB');				//MySQL database name (your host may require prefixes) 
```
	You will also see the $mailServerSetup variable.  The calculator uses PHP's mail function to e-mail users their profile IDs to access their debt profile at any time.  With the below variable set to false, the program will not execute the mail function:<br/>

	$mailServerSetup = false;  <-- set to false if you don't have a mail server setup (eg while working locally).  Set to true if you do have one set up.


The template is named "db_connect(sample).php" - This file will have to be renamed to "db_connect.php" in order for the program to use these settings

##Contribution
I plan to add the ability to pay debts using the "snowball" method.  However, I am currently working on other profjects.  I will gladly accept any contributions to creating a controller class to handle debt repayment using this option.

# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
