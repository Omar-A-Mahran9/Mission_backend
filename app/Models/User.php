<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use App\Models\Scopes\SortingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

    protected $guarded = ["password_confirmation"];
    protected $appends = ['full_image_path', 'full_name', 'average_rating'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->last_name}");
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

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function otp()
    {
        return $this->hasOne(UserOtp::class, 'user_id');
    }
    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Users', "default.svg"));
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function experiences()
    {
        return $this->hasMany(ExcperienceUser::class);
    }
    public function field()
    {
        return $this->hasOne(Field::class, 'id', 'field_id'); // if you want to track created_at/updated_at
    }
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id'); // if you want to track created_at/updated_at
    }

    public function certificates()
    {
        return $this->hasMany(Document::class)->where('type_id', 1);
    }

    public function licenses()
    {
        return $this->hasMany(Document::class)->where('type_id', 2);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    public function reviews()
    {
        return $this->hasMany(Rate::class, 'profissionalist_id');
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rate'), 1); // مثلاً: 4.3
    }
    public function missions()
    {
        return $this->hasMany(Mission::class);
    }
    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'user_interests');
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user');
    }
    public function specialists()
    {
        return $this->belongsToMany(Specialist::class, 'specialist_users');
    }

    public function searchHistory()
    {
        return $this->hasMany(SearchHistory::class);
    }




    public function OfferLogs()
{
    return $this->hasMany(OfferLogs::class, 'freelancer_id');
}

  public function reports(){
        return $this->hasMany(Report::class);
    }

}
