<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentNotification extends Notification
{
    public $post;

    public $commenter;

    public function __construct($post, $commenter)
    {
        $this->post = $post;
        $this->commenter = $commenter;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    

    public function toDatabase($notifiable)
    {
        return [
            'postSlug' => $this->post->slug,
            'postTitle' => $this->post->title,
            'commenterUsername' => $this->commenter->username,
        ];
    }
}

