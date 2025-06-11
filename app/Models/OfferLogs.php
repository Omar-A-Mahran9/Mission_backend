<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferLogs extends Model
{
    
    protected $fillable = [
        'offer_id',
        'offer_status_id',
        'offer_action_at',
        'user_id',
        'mission_id',
        'role', // 1: Client, 2: Freelancer
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
        public function offerStatus()
    {
        return $this->belongsTo(Status::class,'offer_status_id');
    }

   





     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }
}
