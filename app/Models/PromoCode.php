<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    protected $appends = ['status_text'];

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
    public function redemptions()
    {
        return $this->hasMany(PromoCodeRedemption::class);
    }
    public function scopeUsedByOthers($query)
    {
        return $query->whereHas('redemptions', function ($q) {
            $q->where('user_id', auth()->id());
        });
    }
    public function scopeAvailable($query)
    {
        return $query->whereDate('starts_date', '<=', now())
            ->whereDate('expires_at', '>=', now())->where('is_active', true);
    }
    public function getStatusTextAttribute()
    {
        if ($this->is_active) {
            return __('Active');
        }
        return __("Inactive");
    }
}
