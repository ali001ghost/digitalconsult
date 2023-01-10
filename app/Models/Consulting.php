<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulting extends Model
{
    use HasFactory;
   // protected $table ='consultings';
    protected $fillable=['name','id'];
    protected $hidden = ['pivot'];
    

    public function experts()
    {
        return $this->belongsToMany(User::class,'consulting_users','consulting_id');
    }

    public function expResevedDate()
    {
        return $this->hasMany(UserDate::class,'consulting_user_id');
    }
}

