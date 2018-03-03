<?php

namespace Logikool\LaravelEmailLogger\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    
  protected $casts = [
    'to' => 'array',
    'from' => 'array',
    'reply_to' => 'array',
    'cc' => 'array',
    'bcc' => 'array'
  ];

}
