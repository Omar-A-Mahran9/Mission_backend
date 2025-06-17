<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionAttachment extends Model
{
    protected $guarded = [];
    protected $appends = ['full_path'];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }


    public function getFullPathAttribute(): ?string
    {
        return getAttachmentPathFromDirectory($this->file);
    }
}
