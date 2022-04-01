<?php

namespace App\Providers;

use App\Events\Post\PostWasPublishedEvent;
use App\Events\Post\PostWasRejectedEvent;
use App\Listeners\Post\NotifyPostSubscribersListener;
use App\Listeners\Post\SendPostPublishedNotificationListener;
use App\Listeners\Post\SendPostRejectedNotificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PostWasPublishedEvent::class => [
            SendPostPublishedNotificationListener::class,
            NotifyPostSubscribersListener::class,
        ],
        PostWasRejectedEvent::class => [
            SendPostRejectedNotificationListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\Post::observe(\App\Observers\PostObserver::class);
        \App\Models\Category::observe(\App\Observers\CategoryObserver::class);
        \App\Models\User::observe(\App\Observers\UserObserver::class);
    }
}
