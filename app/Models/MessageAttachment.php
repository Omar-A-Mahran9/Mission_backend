<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MessageAttachment extends Model
{
       protected $fillable = [
        'message_id',
        'user_id',
        'file'
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrlAttribute(): string
    {
        return Storage::url($this->file);
    }

    public function getFileNameAttribute(): string
    {
        return basename($this->file);
    }

    public function getFileSizeAttribute(): int
    {
        return Storage::exists($this->file) ? Storage::size($this->file) : 0;
    }

    public function isImage(): bool
    {
        $extension = pathinfo($this->file, PATHINFO_EXTENSION);
        return in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    }

    public function getFileTypeAttribute(): string
    {
        return $this->isImage() ? 'image' : 'file';
    }

}
