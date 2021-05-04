<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptFriend extends Notification
{
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [/*'mail',*/ 'database', /*'broadcast'*/];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
 /*   public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->user->name . " accepted your friend request!")
                    ->action('Profile', route('profile.show', $this->user->slug))
                    ->line('Thank you for using Sites!');
    }*/

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->user->id,
            "username" => $this->user->username,
            "message" => $this->user->username . " accepted your friend request!",
            'extra' =>  "Check " .  $this->user->username . "'s profile to hang out",
        ];
    }
}
