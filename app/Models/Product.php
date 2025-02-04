<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['name', 'description', 'product_price', 'start_price', 'ticket_price'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'date:Y-m-d',
            'updated_at' => 'date:Y-m-d',
        ];
    }
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }
    public function getProductPriceAttribute()
    {
        return number_format($this->attributes['product_price'], 0, '.', ',');
    }
    public function getStartPriceAttribute()
    {
        return number_format($this->attributes['start_price'], 0, '.', ',');
    }
    public function getTicketPriceAttribute()
    {
        return number_format($this->attributes['ticket_price'], 0, '.', ',');
    }
    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'product_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'product_id');
    }
}
