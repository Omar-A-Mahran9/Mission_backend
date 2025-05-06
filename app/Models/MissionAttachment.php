<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionAttachment extends Model
{
    protected $guarded = [];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
