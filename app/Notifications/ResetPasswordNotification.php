<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    private $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->token = $data;

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
           $link = url( "/password/reset/" . $this->token."?email=".$notifiable->getEmailForPasswordReset());

   return ( new MailMessage )
      // ->view('reset.emailer')
      ->view('reset', ['url' => $link, 'data' => $notifiable])
      ->from('support@tibetanbusiness.com')
      ->subject( 'Reset your password' )
      ->line( "Hey, We've successfully changed the text " )
      ->line( 'Thank you!' );

        // $url = url(config('app.url') . route('password.reset', [
        //     'token' => $this->token,
        //     'email' => $notifiable->getEmailForPasswordReset(),
        // ], false));
        // return (new MailMessage)->view('reset', ['url' => $url,'data' => $notifiable]);
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
