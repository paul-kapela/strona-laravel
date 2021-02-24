<?php

namespace App\Notifications;

use App\Answer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnswerAccepted extends Notification
{
    use Queueable;

    protected $answer;
    protected $points;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Answer $answer, int $points)
    {
        $this->answer = $answer;
        $this->points = $points;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //
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
            'answer_id' => $this->answer->id,
            'points' => $this->points
        ];
    }
}
