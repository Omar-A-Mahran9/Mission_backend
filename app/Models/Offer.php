<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'user_id',
        'mission_id',
        'status_id',
        'available_budget',
     ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class,'mission_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }


    public function offerLogs()
{
    return $this->hasMany(OfferLogs::class);
}

    
}
