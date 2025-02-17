<?php

namespace App\Events;

use App\Models\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use App\Http\Resources\Api\ProductResource;
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

    public $product;
    public $auctionHolders;

    /**
     * Create a new event instance.
     */
    public function __construct($product)
    {
        $this->product = (new ProductResource($product))->toArray(request());
        $this->auctionHolders = Ticket::where('product_id', $product->id)->pluck('user_id');
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return collect($this->auctionHolders)->map(function ($userId) {
            return new PrivateChannel('auction-not-live.' . $userId);
        })->toArray();
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
