<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TransactionListResource;

class TransactionHistoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        DB::enableQueryLog();
        $userId = auth()->id();

        $products = Product::whereHas('tickets', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('tickets.refund', 'winners')->get();
        $query = DB::getQueryLog();
        // dd($products);
        // Merge the two collections
        // $transactions = $tickets->merge($winnings);
        return $this->success("", TransactionListResource::collection($products));
    }
}