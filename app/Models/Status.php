<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table='status';
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

    public function missionStatuses()
    {
        return $this->hasMany(MissionStatue::class); // Correcting case-sensitivity
    }

    // Example of appending the name attribute (adjust according to your data)
    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar'? $this->name_ar : $this->name_en; // Assuming you have name_ar and name_en fields
    }


    public function OfferLogs()
{
    return $this->hasMany(OfferLogs::class);
}

 

}
