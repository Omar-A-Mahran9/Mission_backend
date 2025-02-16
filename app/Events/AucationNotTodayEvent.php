<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use App\Http\Resources\Api\ProductResource;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class AucationNotTodayEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $product;
    public $countProduct;

    /**
     * Create a new event instance.
     */
    public function __construct($product, $countProduct)
    {
        $this->product = (new ProductResource($product))->toArray(request());
        $this->countProduct = $countProduct;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('auction-not-today'),
        ];
    }

    public function broadcastWith()
    {
        return [
            'success' => true,
            'data' => ["count" => $this->countProduct, "product" => $this->product],
            'message' => '',
        ];
    }
}
