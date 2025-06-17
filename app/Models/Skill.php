<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $guarded = [];
    protected $appends = ['name'];

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
        // dd($this->attributes['name_' . app()->getLocale()]);
        // if (!$this->attributes['name_' . app()->getLocale()]) {
        //     # code...
        // }
        return $this->attributes['name_' . app()->getLocale()];
    }
}
