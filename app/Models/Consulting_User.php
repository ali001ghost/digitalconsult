<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulting_User extends Model
{
    use HasFactory;

    protected $table='consulting_user';
    protected $fillable=['user_id','consulting_id','price'];
}
