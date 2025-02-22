<?php

namespace App\Models;

use App\Enums\RefundStatus;
use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refund extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['status_text'];

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
    public function getStatusTextAttribute()
    {

        return __(RefundStatus::tryFrom($this->attributes['status'])->name);
    }
    public function user()
    {
        return $this->belongsTo(User::class,);
    }
}
