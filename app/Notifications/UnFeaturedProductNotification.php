<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UnFeaturedProductNotification extends Notification
{
    use Queueable;

    public $productDetail = [];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->productDetail = $data;
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
            ->greeting('Dear ' . $this->productDetail['seller_name'].',')
            ->subject(' Your product '.$this->productDetail['product_title'].' has been marked as unfeatured. '.env('APP_URL'))
            ->line('Greetings from '.env('APP_URL').'!')
            ->line('Your Product '.$this->productDetail['product_title'].'  has been marked as unfeatured. ')
            ->line('Please contact us to mark your product as featured again. ')
            ->action('Click this link to view your product', route('product.show', $this->productDetail['product_slug']))
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
            'message'      => 'Your Product '.$this->productDetail['product_title'].'  has been marked as featured. ',
            'url'          => route('product.show', $this->productDetail['product_slug']),
            'product_slug' => $this->productDetail['product_slug']
        ];
    }
}
