<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;

class ExcperienceUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'created_at' => 'date:Y-m-d',
            'updated_at' => 'date:Y-m-d',
            'otp' => 'string'
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'excperience_user_skills');
    }

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class, 'excperience_user_specialists');
    }
}
