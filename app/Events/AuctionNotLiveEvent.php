<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use App\Http\Resources\Api\AuctionListResource;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class AuctionNotLiveEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $productId;
    public $product;
    /**
     * Create a new event instance.
     */
    public function __construct($productId, $product)
    {
        $this->productId = $productId;
        $this->product = (new AuctionListResource($product))->toArray(request());
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('auction-not-live.' . $this->productId),
        ];
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
