<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Resources\Api\FloatingAuctionListResource;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class FloatingEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;
    public $userId;

    /**
     * Create a new event instance.
     */
    public function __construct($product, $userId)
    {
        $this->product = (FloatingAuctionListResource::collection($product));
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('floating.user.' . $this->userId),
        ];
    }

    public function broadcastWith()
    {
        return [
            'success' => true,
            'data' =>  $this->product,
            'message' => '',
        ];
    }
}
