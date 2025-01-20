<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserOtp extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'date:Y-m-d',
            'updated_at' => 'date:Y-m-d',
        ];
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function sendOTP()
    // {
    //     $this->otp = rand(1111, 9999);
    //     $phone = $this->phone;
    //     if (Str::startsWith($this->phone, '0')) {
    //         $phone = ltrim($this->phone, '0');
    //     }
    //     // $this->sendSMS($phone, $message . ' ' . $this->otp);
    //     $this->save();
    // }
}
