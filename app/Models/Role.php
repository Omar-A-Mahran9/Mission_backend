<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Scopes\WithoutDefaultRole;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['abilities'];
    protected $appends = ['name'];
    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];

    public static $modules = [
        'admins',
        'users',
        'cities',
        'roles',
        'refunds',
        'products',
        'settings',
        'recycle_bin',
        'dashboard'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new WithoutDefaultRole());
    }

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class)->withoutGlobalScope(SortingScope::class)->whereNot('id', 2);
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class);
    }
}
