<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the verification URL for the given notifiable.
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', // route name
            Carbon::now()->addMinutes(60), // expiration
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }

    /**
     * Build the mail representation of the notification.
     */
        public function toMail($notifiable)
        {
            $verificationUrl = $this->verificationUrl($notifiable);

            return (new MailMessage)
                ->subject('Please Verify Your Email Address')
                ->greeting('Hello, ' . $notifiable->name . '!')
                ->line('Please click the button below to verify your email address.')
                ->action('Verify Email Address', $verificationUrl)
                ->line('If you did not create an account, no further action is required.')
                ->line('Regards,')
                ->line('KalaChan Store')
                ->line('If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:')
                ->line($verificationUrl);
        }
}
