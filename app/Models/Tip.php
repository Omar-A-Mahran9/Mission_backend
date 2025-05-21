<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    protected $guarded = [];
    protected $appends = ['title', 'description'];
    protected $casts = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function getTitleAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()] ?? null;
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()] ?? null;
    }

}
