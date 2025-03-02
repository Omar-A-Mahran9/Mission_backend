<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'product_price' => $this->product_price,
            'start_price' => $this->start_price,
            'status_name' => $this->getTransactionStatusName(),
            'status' => $this->getTransactionStatus(),
            'amount' => $this->getTransactionAmount(),
            'date' => $this->getTransactionDate(),
            'bid_count' => $this->bids_count,
            'participants_count' => $this->participants_count,
            'highest_rank' => HighestRankListResource::collection($this->highest_rank),
            'full_image_path' => $this->images->pluck('full_image_path'),

        ];
    }
    private function getTransactionStatusName()
    {
        $userId = auth()->id();
        $winner = $this->winners->firstWhere('user_id', $userId);
        $ticket = $this->tickets->first(); // Get first ticket if exists

        //  1. User won and received the product
        if ($winner && $winner->is_delivered) {
            return __('It was received');
        }

        //  2. User won, paid but not received
        if ($winner && $winner->is_bought) {
            return __('Payment has been made');
        }

        //  3. User won but did not pay
        if ($winner) {
            $paymentDeadline = Carbon::parse($winner->created_at)->addHours((int) setting('time_left_to_pay'));
            if (Carbon::now()->greaterThan($paymentDeadline)) {
                return __("You didn't win");
            }
            return __('Payment pending');
        }

        //  4. User had a ticket and got refunded
        if ($ticket && $ticket->refund) {
            return __('Refunded');
        }

        //  5. User bought a ticket but did not win
        if ($ticket) {
            return __('Paid the ticket');
        }

        //  6. User lost the auction
        return __("You didn't win");
    }
    private function getTransactionStatus()
    {
        $userId = auth()->id();
        $winner = $this->winners->firstWhere('user_id', $userId);
        $ticket = $this->tickets->first();

        //  1. User won and received the product
        if ($winner && $winner->is_delivered) {
            return 7;
        }

        //  2. User won, paid but not received
        if ($winner && $winner->is_bought) {
            return 6;
        }

        //  3. User won but did not pay
        if ($winner) {
            // Calculate the deadline
            $paymentDeadline = Carbon::parse($winner->created_at)->addHours((int) setting('time_left_to_pay'));
            if (Carbon::now()->greaterThan($paymentDeadline)) {
                return 1;
            }
            return 4;
        }

        //  4. User had a ticket and got refunded
        if ($ticket && $ticket->refund) {
            return 2;
        }

        //  5. User bought a ticket but did not win
        if ($ticket) {
            return 1;
        }

        //  6. User lost the auction
        return 1;
    }
    private function getTransactionAmount()
    {
        $userId = auth()->id();
        $winner = $this->winners->firstWhere('user_id', $userId);
        $ticket = $this->tickets->first();
        //  1. User won and received the product
        if ($winner && $winner->is_delivered) {
            return $winner->bid->amount;
        }

        //  2. User won, paid but not received
        if ($winner && $winner->is_bought) {
            return $winner->bid->amount;
        }

        //  3. User won but did not pay
        if ($winner) {
            $paymentDeadline = Carbon::parse($winner->created_at)->addHours((int) setting('time_left_to_pay'));
            if (Carbon::now()->greaterThan($paymentDeadline)) {
                return $this->ticket_price;
            }
            return $winner->bid->amount;
        }

        //  4. User had a ticket and got refunded
        if ($ticket && $ticket->refund) {
            return $this->ticket_price;
        }

        //  5. User bought a ticket but did not win
        if ($ticket) {
            return $this->ticket_price;
        }

        //  6. User lost the auction
        return $this->ticket_price;
    }
    private function getTransactionDate()
    {
        $userId = auth()->id();
        $winner = $this->winners->firstWhere('user_id', $userId);
        $ticket = $this->tickets->first();

        //  1. User won and received the product
        if ($winner && $winner->is_delivered) {
            return Carbon::parse($winner->deliverd_at)->format('Y-m-d');
        }

        //  2. User won, paid but not received
        if ($winner && $winner->is_bought) {
            return Carbon::parse($winner->paid_at)->format('Y-m-d');
        }

        //  3. User won but did not pay
        if ($winner) {
            // Calculate the deadline
            $paymentDeadline = Carbon::parse($winner->created_at)->addHours((int) setting('time_left_to_pay'));
            if (Carbon::now()->greaterThan($paymentDeadline)) {
                return Carbon::parse($ticket->created_at)->format('Y-m-d');
            }
            return Carbon::now()->diffForHumans(Carbon::parse($this->winners->first()->created_at)->addHours((int) setting('time_left_to_pay')));
        }

        //  4. User had a ticket and got refunded
        if ($ticket && $ticket->refund) {
            return Carbon::parse($ticket->refund->created_at)->format('Y-m-d');
        }

        //  5. User bought a ticket but did not win
        if ($ticket) {
            return Carbon::parse($ticket->created_at)->format('Y-m-d');
        }

        //  6. User lost the auction
        return Carbon::parse($ticket->created_at)->format('Y-m-d');
    }
}
