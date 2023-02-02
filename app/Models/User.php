<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    public function parcel()
    {
        return $this->hasMany(Parcel::class);
    }

    public function house()
    {
        return $this->hasMany(House::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function apartment()
    {
        return $this->hasMany(Apartment::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'trade_name',
        'name',
        'address',
        'license',
        'phone',
        'whatsapp_phone',
        'telegram_phone',
        'personal_email',
        'twitter_account',
        'facebook_account',
        'logo',
        'email',
        'password',
        'status',
        'personal_document_image',
        'commercial_license_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }
}
