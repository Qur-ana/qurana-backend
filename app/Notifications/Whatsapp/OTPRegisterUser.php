<?php

namespace App\Notifications\Whatsapp;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Broadcasting\WhatsappChannel;
use App\Models\User;

class OTPRegisterUser extends Notification
{
    use Queueable;

    private $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(User $notifiable): string
    {
        return WhatsappChannel::class;
    }

    /**
     * Get the whatsapp representation of the notification.
     */
    public function toWhatsapp(User $notifiable): string
    {
        return 'Hai ' . $notifiable->name . ', OTP Qurana anda adalah: ' . $this->otp . '. Jangan berikan kode ini kepada siapapun. Terima kasih.';
    }
}
