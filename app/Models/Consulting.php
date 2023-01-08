<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulting extends Model
{
    use HasFactory;
   // protected $table ='consultings';
    protected $fillable=['name','id'];

    public function experts()
    {
        return $this->belongsToMany(User::class,'consulting_users','user');
    }
}

