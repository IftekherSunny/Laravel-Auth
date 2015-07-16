## Sun Auth

The Sun Auth package helps you to protect your application from Unauthorized user.

## Installation Process

In order to install Sun Auth, just add

```
 "sun/laravel-auth": "1.*"
```
to your composer.json. Then run composer install or composer update.

Then in your config/app.php add

```
 Sun\Auth\AuthServiceProvider::class,
```
in the providers array.

In the config/session.php 'expire_on_close' set to true.

```
 'expire_on_close' => true,
```

You need three extra column in your users table for this package.

```
$table->string('tempPassword', 60);
$table->boolean('active');
$table->string('code', 32);
```

add this 3 lines of code in your users migration file. Then, run

```
php artisan migrate:refresh
```

Then publish Sun Auth's assets with 

```
php artisan vendor:publish
```

This command will publish all of the assets, views and config files.

#### Changing Sun Auth Default Configuration

You can also change Sun Auth default configuration. In the config/SunAuth.php setup your application name, url, favicon link, User model namespace.
 
```php
return [
    'app'  => [
        'name' => 'My Awesome App',
        'url'   => 'http://localhost:8000',
        'favicon-url' => 'http://myawesomeapp.com/favicon.png'
    ],
    'user-model-namespace'  => 'App\User',
    'redirect-after-login'  => '/'
];

```
## Screenshots

###### Login:

![Login](https://github.com/IftekherSunny/screenshot/blob/master/Laravel-Auth/1.png)

###### Register:

![Register](https://github.com/IftekherSunny/screenshot/blob/master/Laravel-Auth/2.png)

###### Register Success:

![Register Success](https://github.com/IftekherSunny/screenshot/blob/master/Laravel-Auth/3.png)

###### Confirmation Email:

![Confirmation Email](https://github.com/IftekherSunny/screenshot/blob/master/Laravel-Auth/4.png)

###### Password Reset:

![Password Reset](https://github.com/IftekherSunny/screenshot/blob/master/Laravel-Auth/5.png)

###### New Password Confirmation Email:

![New Password Confirmation Email](https://github.com/IftekherSunny/screenshot/blob/master/Laravel-Auth/6.png)



## License

This package is licensed under the [MIT License](https://github.com/IftekherSunny/laravel-auth/blob/master/LICENSE)
