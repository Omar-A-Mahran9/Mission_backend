<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //

    protected $guarded = ['id'];
        protected $appends = ['name'];


 public function missions()
{
    return $this->belongsToMany(Mission::class)
                ->withTimestamps();
 }
 
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }
 
 
 public function user(){
        return $this->belongsTo(User::class);
    }
}
