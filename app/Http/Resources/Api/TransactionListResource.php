<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionListResource extends JsonResource
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
            'status' => $this->getTransactionStatus(),
            'amount' => $this->getTransactionAmount(),
            'date' => $this->getTransactionDate(),
            'full_image_path' => $this->images()->first()->full_image_path ?? null,

        ];
    }
    private function getTransactionStatus()
    {
        // dd($this->tickets->first()?->refund,$this->winners);
        // If there is a ticket and it has a refund
        if ($this->tickets->first()?->refund) {
            return __('Refunded');
        }

        // Check if the user is the winner
        $winner = $this->winners->first();
        if ($winner) {
            if ($winner->is_delivered) {
                return __('It was received');
            }
            return $winner->is_bought ? __('Paid') : __('Not Paid');
        }

        return __('Paid the ticket');
    }
    private function getTransactionAmount()
    {
        $winner = $this->winners->first();
        if ($winner) {
            return $winner->is_bought ? $this->product_price : 0;
        }

        if ($this->tickets->isNotEmpty()) {
            return $this->ticket_price; // Ticket purchase price
        }
        return null;
    }

    private function getTransactionDate()
    {
        $winner = $this->winners->first();

        if ($this->tickets->isNotEmpty()) {
            return Carbon::parse($this->tickets->first()->create_time)->format('Y-m-d');
        }

        if ($winner) {
            return Carbon::parse($winner->paid_at ?? $winner->updated_at)->format('Y-m-d');
        }

        return null;
    }
}