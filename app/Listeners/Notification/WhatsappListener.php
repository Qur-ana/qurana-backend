<?php

namespace App\Listeners\Notification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\User\UserRegistered;
use App\Notifications\Whatsapp\OTPRegisterUser;
use App\Models\User;

class WhatsappListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $otp = 123456;
        $event->user->notify(new OTPRegisterUser($otp));
    }
}
