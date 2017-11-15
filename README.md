Laravel Modules
===============

Simple helpers for adding modular architecture to your Laravel project.

# Overview

Modular architecture makes your application easier to understand and 
scale. This package attempts to add support for modules with minimal
effort and greatest amount of flexibility. A `Module` in this package
corresponds with a module grouping of code in your project.

# Installation

Install the base package with composer.

~~~ bash
$ composer install zingle-com/laravel-modules
~~~

Add service provider to your providers after the Illuminate providers, 
but before your project service providers.

~~~ php
// config.php
// ...
	'providers' => [
		// ...
		Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,

        /**
         * Vendors
         */
    	// ...
    	ZingleCom\LaravelModules\ModuleServiceProvider::class,

    	// ...
    	/**
    	 * Project providers
    	 */
	],
~~~

Finally install the vendor assets:

~~~ bash
$ php artisan vendor:publish --provider="ZingleCom\LaravelModules\ModuleServiceProvider::class"
~~~

# Usage

After defining your modular structure, to create a new module simply 
create add a new class that extends `Module` to your base module 
directory that corresponds with the name of the module. For example,
if you had a module named `Auth` the base directory for which is
`app/Modules/Auth` you would create the following class:

~~~ php
namespace App\Modules\Auth;

use ZingleCom\LaravelModules\Module\Module;

class AuthModule extends Module
{

}
~~~

Then add the new module class to `config/modules.php` under the modules key like:

~~~ php
// modules.php
// ..
	"modules" => [
		App\Modules\Auth\AuthModule::class,
	],
~~~
