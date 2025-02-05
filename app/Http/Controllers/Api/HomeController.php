<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\ProductResource;
use App\Http\Requests\Api\StoreRefundRequest;
use App\Http\Requests\Api\StoreTicketRequest;
use App\Http\Resources\Api\ProductListResource;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        // DB::enableQueryLog();
        $products = Product::with('tickets')->when($request->type === 'today', function ($query) use ($today) {
            return $query->whereDate('start_time', $today)
                ->whereTime('start_time', '>', Carbon::now());
        }, function ($query) use ($today) {
            return $query->whereDate('start_time', '>', $today);
        })->withCount(['tickets as refunded_tickets_count' => function ($query) {
            $query->whereDoesntHave('refunds'); // Only count tickets that have refunds
        }])->paginate(8);
        // $query = DB::getQueryLog();
        return $this->successWithPagination("", ProductListResource::collection($products)->response()->getData(true));
    }
    public function show(Product $product)
    {
        $product->loadCount('bids');
        return $this->success("Successfully", new ProductResource($product));
    }
    public function buyTicket(Request $request, Product $product)
    {
        $user = auth()->user();
        $product->loadCount('bids');
        if (now()->greaterThan($product->start_time)) {
            return $this->failure(__('The product has already started'));
        }
        $ticket = $product->tickets()->where('user_id', $user->id);
        if ($ticket->exists()) {
            return $this->failure(__('You already have a ticket for this product'));
        }
        // $product->tickets()->create([
        //     'user_id' => $user->id,
        // ]);
        return $this->success("Successfully", new ProductResource($product));
    }
    public function refund(StoreRefundRequest $request, Product $product)
    {
        $data = $request->validated();
        // Find the user's ticket for this product
        $ticket = Ticket::with('refunds')->where('product_id', $product->id)
            ->where('user_id', auth()->user()->id)
            ->first();
        // If no ticket found, return an error
        if (!$ticket) {
            return $this->failure(__('No ticket found for this product'));
        }
        // Check if the ticket already has a refund
        if ($ticket->refunds()->exists()) {
            return $this->failure(__('Refund already exists for this ticket'));
        }
        $ticket->refunds()->create($data);
        return $this->success("Successfully", []);
    }
}
