<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable=['role','name','image','password','phone','bag'];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function experince()
    {
        return $this->hasMany(Experince::class);
    }

    public function costumer_date()
    {
        return $this->hasMany(UserDate::class);
    }

    public function consultings()
    {
        return $this->belongsToMany(Consulting::class,'consulting_users');
    }

   
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
}
