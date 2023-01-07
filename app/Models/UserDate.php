<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDate extends Model
{

    protected $fillable = ['consulting_user_id','user_id','date'];
    use HasFactory;

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function expday()
    {

        return $this->belongsTo(ExpDay::class);


    }

    public function consultingUser()
    {

        return $this->belongsTo(Consulting_User::class,'consulting_user_id');
    }




}
