<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;

class PromoCodeRedemption extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }
}
