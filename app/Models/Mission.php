<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mission extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $appends = [];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
        'is_publish' => 'boolean',
        'available_attachment' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    // 🔗 Many-to-many relationship with skills
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'mission_skills');
    }

    // 📎 One-to-many relationship with mission attachments
    public function attachments(): HasMany
    {
        return $this->hasMany(MissionAttachment::class);
    }
    public function field()
    {
        return $this->hasOne(Field::class, 'id', 'field_id'); // if you want to track created_at/updated_at
    }
    public function specialist()
    {
        return $this->hasOne(Specialist::class, 'id', 'specialist_id'); // if you want to track created_at/updated_at
    }
    public function payment()
    {
        return $this->hasOne(Payment_way::class, 'id', 'payment_way_id'); // if you want to track created_at/updated_at
    }
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id'); // if you want to track created_at/updated_at
    }
    public function statue(): HasMany
    {
        return $this->hasMany(MissionStatue::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lastStatue()
    {
        return $this->hasOne(MissionStatue::class)->latestOfMany();
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
