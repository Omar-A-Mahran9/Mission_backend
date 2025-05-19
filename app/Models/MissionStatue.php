<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;

class MissionStatue extends Model
{
    protected $table='mission_status';
    protected $guarded = [];
    protected $appends = [];

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



    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class); // Correcting case-sensitivity
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
