<?php

namespace App\Listeners\Post;

use App\Events\Post\PostWasPublishedEvent;
use App\Notifications\Post\PostPublishedNotification;
use Illuminate\Support\Facades\Notification;

class SendPostPublishedNotificationListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Post\PostWasPublishedEvent  $event
     * @return void
     */
    public function handle(PostWasPublishedEvent $event)
    {
        return Notification::send($event->post->author, new PostPublishedNotification($event->post));
    }
}
