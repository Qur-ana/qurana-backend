<?php

namespace App\Listeners\Notification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\User\UserRegistered;
use App\Notifications\Whatsapp\OTPRegisterUser;
use App\Models\User;
use App\Repository\OTPRepository\EloquentOTPRepository;

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
        $repository = new EloquentOTPRepository();
        $otp = $event->is_resend ? $repository->resendOTP($event->user->phone) : $repository->createOTP($event->user->phone);
        $event->user->notify(new OTPRegisterUser($otp->otp));
    }
}
