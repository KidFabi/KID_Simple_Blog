<?php

namespace App\Listeners\Post;

use App\Events\Post\PostWasPublishedEvent;
use App\Notifications\Post\NotifySubscribersNotification;
use App\Services\UserService;
use Illuminate\Support\Facades\Notification;

class NotifyPostSubscribersListener
{
    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Post\PostWasPublishedEvent  $event
     * @return void
     */
    public function handle(PostWasPublishedEvent $event)
    {
        $userList = $this->userService->getSubscribers();

        return Notification::send($userList, new NotifySubscribersNotification($event->post));
    }
}
