<?php

return [

  'model' => \Logikool\LaravelEmailLogger\Models\EmailLog::class,

  'listeners' => [
    'MessageSending' => \Logikool\LaravelEmailLogger\Listeners\MessageSending::class,
    'MessageSent' => \Logikool\LaravelEmailLogger\Listeners\MessageSent::class,
  ]

];