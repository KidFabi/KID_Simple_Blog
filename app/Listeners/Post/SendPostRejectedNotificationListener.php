<?php

namespace App\Listeners\Post;

use App\Events\Post\PostWasRejectedEvent;
use App\Notifications\Post\PostRejectedNotification;
use Illuminate\Support\Facades\Notification;

class SendPostRejectedNotificationListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Post\PostWasRejectedEvent  $event
     * @return void
     */
    public function handle(PostWasRejectedEvent $event)
    {
        return Notification::send($event->post->author, new PostRejectedNotification($event->post));
    }
}
