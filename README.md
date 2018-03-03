# Laravel Email Logger

This package provides a simple logging mechanism for all emails that are sent in your application. It uses Laravel's built in events which the logger listens to and creates a database entry from a ```Swift_Message``` object.

## Installation

1. Install via composer

```bash
composer require logikool/laravel-email-logger
```

2. If you are not using package auto-discovery, add the service provider to your ```app.php``` configuration file.

```php
Logikool\LaravelEmailLogger\LaravelEmailLoggerServiceProvider::class,
```

3. Publish configuration and migration files

```bash
php artisan vendor:publish --provider="Logikool\LaravelEmailLogger\LaravelEmailLoggerServiceProvider"
```
4. Run the migration

```bash
php artisan migrate
```
## Configuration

Laravel Email Logger has it's own Eloquent model and Event Listeners, but if you need to, you can change those in your ```email-logger.php```.

```php
return [

  'model' => \Logikool\LaravelEmailLogger\Models\EmailLog::class,

  'listeners' => [
    'MessageSending' => \Logikool\LaravelEmailLogger\Listeners\MessageSending::class,
    'MessageSent' => \Logikool\LaravelEmailLogger\Listeners\MessageSent::class,
  ]

];
```

```MessageSending``` and ```MessageSent``` are Laravel's built-in events and you can use your own listeners by providing a fully qualified class name.

```EmailLog``` is a model which you can replace or extend if you need to.