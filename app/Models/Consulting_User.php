<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulting_User extends Model
{
    use HasFactory;

    protected $table='consulting_users';
    protected $fillable=['user_id','consulting_id','price'];


    public function userdate()
    {

        return $this->hasMany(UserDate::class,'consulting_user_id');
    }

    public function user()
    {

        return $this->belongsTo(User::class,'user_id');
    }

    public function consulting()
    {

        return $this->belongsTo(Consulting::class,'consulting_id');
    }

}
