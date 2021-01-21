<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Events\Verified;
use App\Notifications\EmailVerified;

class SendEmailVerifiedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        if ($event->user instanceof MustVerifyEmail && $event->user->hasVerifiedEmail()) {
            Notification::send($event->user, new EmailVerified());
        }
    }
}
