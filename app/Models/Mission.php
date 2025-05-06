<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $guarded = [];
    protected $appends = ['description'];
    protected $casts = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];

    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }


    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()] ?? null;
    }
}
