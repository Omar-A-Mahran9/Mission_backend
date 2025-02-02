<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $guarded = ['roles'];
    protected $casts   = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];
    protected $guard = 'admin';

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->where('id', '!=', 2)->withTimestamps();
    }

    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'cities_id');
    }

    public function providers()
    {
        return $this->hasMany(UserProvider::class);
    }

    public function otp()
    {
        return $this->hasOne(UserOtp::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class, 'tickets_users_id');
    }
}
