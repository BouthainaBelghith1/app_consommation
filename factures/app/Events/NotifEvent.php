<?php

namespace App\Events;

use BeyondCode\LaravelWebSockets\WebSockets\Channels\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class Notif implements ShouldBroadcastNow
{
    use SerializesModels;

    private $notif;

    public function __construct($notif)
    {
        $this->notif = $notif;
    }

    public function broadcastWith()
    {
        return ['message' => $this->notif];
    }

    public function broadcastOn()
    {
        return new Channel('public');
    }
}