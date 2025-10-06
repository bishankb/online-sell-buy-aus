<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ViewerMailNotification extends Notification
{
    use Queueable;

    public $viewerData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->viewerData = $data;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Dear '.$this->viewerData['name'])
            ->subject('New Contact Us Message')
            ->line('Greetings from '.env('APP_URL').'!')
            ->line('**Name:** ' . $this->viewerData['name'])
            ->line('**Email:** ' . $this->viewerData['email'])
            ->line('**Phone:** ' . $this->viewerData['phone'])
            ->line('**Subject:** ' . $this->viewerData['subject'])
            ->line('**Message:**')
            ->line($this->viewerData['message'])
            ->line('Thank you.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'New message from'. $this->viewerData['name'],
            'url'   => config('product.company_gmail_url'),
        ];
    }
}
