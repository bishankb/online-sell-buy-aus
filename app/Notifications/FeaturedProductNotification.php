<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeaturedProductNotification extends Notification
{
    use Queueable;

    public $featuredProduct = [];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->featuredProduct = $data;
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
            ->greeting('Dear ' . $this->featuredProduct['seller_name'].',')
            ->subject(' Your product has been marked as featured. '.env('APP_URL'))
            ->line('Greetings from '.env('APP_URL').'!')
            ->line('Your Product '.$this->featuredProduct['product_title'].'  has been marked as featured. ')
            ->action('Click this link to view your product', route('product.show', $this->featuredProduct['product_slug']))
            ->line('Thank you for being our partner.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message'      => 'Your Product '.$this->featuredProduct['product_title'].'  has been marked as featured. ',
            'url'          => route('product.show', $this->featuredProduct['product_slug']),
            'product_slug' => $this->featuredProduct['product_slug']
        ];
    }
}
