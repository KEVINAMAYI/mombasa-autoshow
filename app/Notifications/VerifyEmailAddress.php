<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailAddress extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public function toMail($notifiable)
    {

        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->view('emails.verification', [
                'verificationUrl' => $verificationUrl,
                'userName' => $notifiable->first_name.' '.$notifiable->last_name
            ]);
    }

}
