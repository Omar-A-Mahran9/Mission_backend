<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('create_products');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar' => ['required', 'max:100', new NotNumbersOnly()],
            'name_en' => ['required', 'max:100', new NotNumbersOnly()],
            'description_ar' => ['required', 'max:255', new NotNumbersOnly()],
            'description_en' => ['required', 'max:255', new NotNumbersOnly()],
            'product_price' => ['required', 'numeric', 'min:1'],
            'minimum_bid' => ['required', 'numeric', 'min:1'],
            'bid_price' => ['required', 'numeric', 'min:1'],
            'start_price' => ['required', 'numeric', 'min:1'],
            'ticket_price' => ['required', 'numeric', 'min:1'],
            'start_time' => ['required', 'date', 'after_or_equal:today'],
            'end_time' => ['required', 'date', 'after:start_time'],
            'variations' => ['required', 'array', 'min:1'],
            'variations.*.bidding_discount_percentage' => ['required', 'numeric', 'gt:0'],
            'variations.*.final_bidding_percentage' => ['required', 'numeric', 'gt:0'],
            'images' => 'required|array|min:1|max:10',
            'images.*' => 'required|mimes:jpeg,jpg,png,gif,svg|max:512',
        ];
    }
}
