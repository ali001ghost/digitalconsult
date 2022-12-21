<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDate extends Model
{
    use HasFactory;

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function expday()
    {

        return $this->belongsTo(ExpDay::class);
    }
}
