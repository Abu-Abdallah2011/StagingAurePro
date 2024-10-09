<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MarriageRegisteredNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    //  added
    protected $marriage;
    public function __construct($marriage)
    {
        $this->marriage = $marriage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail', 'database'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Assalaamu Alaikum Wa Rahmatul Laah! A new Marriage has been Registered with Your Masjid.')
                    ->action('To Approve the Marriage after Verifying the Documents, Click this Link:', url('/marriages_database/' . $this->marriage->id))
                    ->line('Jazaakumul Laahu Khairan for using our AurePro!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'A new marriage has been registered with ' . $this->marriage->masjid->name,
            'marriage_id' => $this->marriage->id,
        ];
    }
}
