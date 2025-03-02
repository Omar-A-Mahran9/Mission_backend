<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Http\Resources\Api\AuctionResource;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use App\Http\Controllers\Api\AuctionController;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class BidPlacedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $product;

    /**
     * Create a new event instance.
     */
    public function __construct($product)
    {
        $product->bid_amount = AuctionController::placeBid($product);
        $this->product = (new AuctionResource($product));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('bid.' . $this->product->id),
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
