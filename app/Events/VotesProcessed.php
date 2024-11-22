<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VotesProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $userId;
    public $vehicleId;

    /**
     * Create a new event instance.
     */
    public function __construct($userId, $vehicleId)
    {
        $this->userId = $userId;
        $this->vehicleId = $vehicleId;
    }

}
