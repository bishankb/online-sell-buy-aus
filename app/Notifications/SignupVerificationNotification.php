<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class SignupVerificationNotification extends Notification
{
    use Queueable;
    
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );

        return (new MailMessage())
                    ->greeting('Dear ' . $notifiable->name.',')
                    ->line('We are glad for your registration in our site.')
                    ->subject('Confirmation Mail from '.env('APP_NAME').' '.env('APP_URL'))        
                    ->line('This email is sent to verify your account.')
                    ->action('Click here to Activate', $verificationUrl)
                    ->line('Thank you for being our partner.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message'=>'Welcome '.$notifiable['name'].' to '.env('APP_NAME'),
            'url'=>''
        ];
    }
}
