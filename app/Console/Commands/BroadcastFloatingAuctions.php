<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Product;
use App\Events\FloatingEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BroadcastFloatingAuctions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:broadcast-floating-auctions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Broadcast floating auctions to the corresponding users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString(); // Get today's date (YYYY-MM-DD)
        $now = Carbon::now()->toTimeString(); // Get current time (HH:MM:SS)
        $user = auth()->user();
        $products = Product::whereDate('start_time', $today) // Check if date matches today
            ->whereTime('start_time', '<', $now)->whereTime('end_time', '>=', $now)->whereHas('tickets', function ($query) use ($user) {
                $query->where('user_id', $user->id); // Only tickets that belong to this user
            })->get();
        if ($products) {
            broadcast(new FloatingEvent($products, auth()->id()));
            Log::info('Completed BroadcastFloatingAuctions Cron Job.');
        }
    }
}
