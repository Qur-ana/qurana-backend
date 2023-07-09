<?php

namespace App\Events\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public bool $is_resend;
    /**
     * Create a new event instance.
     */
    public function __construct(User $user, bool $is_resend = false)
    {
        $this->user = $user;
        $this->is_resend = $is_resend;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
