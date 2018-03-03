<?php

namespace Logikool\LaravelEmailLogger;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Mail\Events\MessageSending as MessageSendingEvent;
use Illuminate\Mail\Events\MessageSent as MessageSentEvent;
use Listeners\MessageSending as MessageSendingListener;
use Listeners\MessageSent as MessageSentListener;

class LaravelEmailLoggerServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the logger.
     *
     * @var array
     */
    protected $listen = [];
    protected $publishablePath;

    public function __construct($app)
    {
        
        parent::__construct($app);
        
        $this->listen = [
            \Illuminate\Mail\Events\MessageSending::class => [
                config('email-logger.listeners.MessageSending', \Logikool\LaravelEmailLogger\Listeners\MessageSending::class),
            ],
            \Illuminate\Mail\Events\MessageSent::class => [
                config('email-logger.listeners.MessageSending', \Logikool\LaravelEmailLogger\Listeners\MessageSending::class),
            ],
        ];

        $this->publishablePath = __DIR__ . '/../publishable';

    }

    /**
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('email-logger', function () {
            return new EmailLogger();
        });

        $this->registerConfigs();

        if($this->app->runningInConsole()){
            $this->registerPublishableResources();
        }

    }

    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {

        $publishable = [
            'config' => [
                "{$this->publishablePath}/config/email-logger.php" => config_path('email-logger.php'),
            ],
            'migrations' => [
                "{$this->publishablePath}/migrations/" => database_path('migrations'),
            ],
        ];
        
        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }

    }

    public function registerConfigs()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/publishable/config/email-logger.php', 'email-logger'
        );
    }

}
