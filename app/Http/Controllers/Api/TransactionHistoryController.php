<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TransactionResource;
use App\Http\Resources\Api\TransactionListResource;

class TransactionHistoryController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $products = Product::whereHas('tickets', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('tickets.refund', 'bids', 'winners')->paginate(8);
        return $this->successWithPagination("", TransactionListResource::collection($products)->response()->getData(true));
    }

    public function show(Product $product)
    {
        $userId = auth()->id();
        // Ensure the user has a ticket for this product
        if (!$product->tickets()->where('user_id', $userId)->exists()) {
            return $this->failure(__('You have no transaction history for this product'));
        }
        $product->loadCount([
            'bids'
        ])->load('tickets.refund', 'bids', 'winners', 'images');
        $product->participants_count = $product->bids()
            ->distinct()
            ->count('user_id');
        $product->highest_rank = $this->getHighestBids($product);

        return $this->success("", new TransactionResource($product));
    }

    /**
     * Get highest bids per unique user.
     */
    private function getHighestBids(Product $product)
    {
        return $product->bids()
            ->whereIn('id', function ($query) use ($product) {
                $query->selectRaw('MAX(id)')
                    ->from('bids')
                    ->where('product_id', $product->id)
                    ->groupBy('user_id'); // Ensures unique user_id
            })
            ->with('user')
            ->orderByDesc('bid_amount')
            ->limit(5)
            ->get();
    }
}
