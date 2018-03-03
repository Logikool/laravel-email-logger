<?php

namespace Logikool\LaravelEmailLogger\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Logikool\LaravelEmailLogger\Facades\EmailLogger;

class MessageSent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        EmailLogger::log($event->message, class_basename($event));
    }
}
