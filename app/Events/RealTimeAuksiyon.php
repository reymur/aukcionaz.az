<?php

namespace App\Events;

use App\Models\AuksiyonGamer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RealTimeAuksiyon implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

//    public function broadcastOn()
//    {
//        return new PrivateChannel('channel-name');
//    }

    /**
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('auksiyon');
    }
}
