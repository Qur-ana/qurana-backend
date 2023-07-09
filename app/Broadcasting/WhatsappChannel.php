<?php

namespace App\Broadcasting;

use App\Notifications\Whatsapp\OtpRegisterUser;
use Illuminate\Notifications\Notification;
use App\Models\User;
use GuzzleHttp\Client;

class WhatsappChannel
{
    private string $token;
    private string $host;
    private string $sender;
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        $this->token = config('whatsapp.api_key');
        $this->host = config('whatsapp.api_url');
        $this->sender = config('whatsapp.sender');
    }

    /**
     * Send Message Through Whatsapp
     */
    public function send(User $notifiable, OtpRegisterUser $notification): bool
    {
        $message = $notification->toWhatsapp($notifiable);
        $client = new Client();
        $response = $client->request('POST', $this->host . 'send-message', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'number' => $notifiable->phone,
                'message' => $notification->toWhatsapp($notifiable),
                'api_key' => $this->token,
                'sender' => $this->sender,
            ],
        ]);
        return $response->getStatusCode() === 200;
    }
}
