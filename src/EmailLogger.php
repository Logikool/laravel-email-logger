<?php

namespace Logikool\LaravelEmailLogger;

use Exceptions\EmailLoggerModelNotFoundException;

class EmailLogger
{

    /**
     * Log email info from Swift_Message object.
     *
     * @param  \Swift_Message  $message
     * @return void
     */
    public function log($message, $event)
    {
      
      $modelClass = config('email-logger.model', Models\EmailLog::class);

      if(!class_exists($modelClass)){
        throw new EmailLoggerModelNotFoundException;
      }

      $model = new $modelClass;

      $model->from = $message->getFrom();
      $model->to = $message->getTo();
      $model->cc = $message->getCc();
      $model->bcc = $message->getBcc();
      $model->reply_to = $message->getReplyTo();
      $model->body = $message->getBody();
      $model->mail_id = $message->getId();
      $model->event = $event;
      $model->save();

    }

}