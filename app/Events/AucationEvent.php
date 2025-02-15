<?php

namespace App\Events;

use App\Http\Resources\Api\ProductResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AucationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;

    /**
     * Create a new event instance.
     */
    public function __construct($product)
    {
        $this->product = (new ProductResource($product))->toArray(request());
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn()
    {
        return new Channel('auction-channel'); // Public channel
        // return new PrivateChannel('auction-channel'); // Use for authenticated users only
    }

    public function broadcastWith()
    {
        return [
            'success' => true,
            'data' => $this->product,
            'message' => '',
        ];
    }
}