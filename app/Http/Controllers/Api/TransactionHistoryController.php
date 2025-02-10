<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TransactionListResource;

class TransactionHistoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $userId = auth()->id();

        // Retrieve tickets purchased by the user
        $tickets = Ticket::where('users_id', $userId)
            ->with(['product', 'refunds'])
            ->orderByDesc('create_time')
            ->get();

        // Retrieve auctions the user won
        $winnings = Winner::where('bids_users_id', $userId)
            ->with(['product'])
            ->orderByDesc('updated_at')
            ->get();

        // Merge the two collections
        $transactions = $tickets->merge($winnings);
        return $this->success("", TransactionListResource::collection($transactions));
    }
}
