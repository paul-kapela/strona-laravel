<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class EmailChange extends Notification
{
    use Queueable;

    protected $userId;
    protected $newEmail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, string $newEmail)
    {
        $this->userId = $user->id;
        $this->newEmail = $newEmail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $confirmationUrl = $this->verifyRoute($notifiable);

        return (new MailMessage)
            ->subject(env('APP_NAME').' - '.__('email/confirm_email_change.topic'))
            ->line(__('email/confirm_email_change.before', [
                'newEmail' => $this->newEmail
            ]))
            ->action(__('email/confirm_email_change.confirm_button'), $confirmationUrl)
            ->line(__('email/confirm_email_change.if_not_requested'));
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
            'newEmail' => $this->newEmail
        ];
    }

    protected function verifyRoute($notifiable)
    {
        return URL::temporarySignedRoute('email.change', 60 * 60, [
            'user' => $this->userId,
            'newEmail' => $this->newEmail
        ]);
    }
}
