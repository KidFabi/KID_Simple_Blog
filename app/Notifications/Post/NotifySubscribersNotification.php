<?php

namespace App\Notifications\Post;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifySubscribersNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var \App\Models\Post
     */
    protected $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__('New Post Published') .' - ' . config('app.name', 'KID Simple Blog'))
                    ->greeting(__('Hello,'))
                    ->line(__('We are pleased to notify you about a new post published on our blog. Click the button bellow to check it out.'))
                    ->action(__($this->post->shortTitle()), route('posts.show', $this->post->id))
                    ->line(__('If you do not want receive such messages in the future, please disable notifications in the settings of your account.'))
                    ->line('Thank you for using the blog!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
