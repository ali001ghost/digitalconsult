<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpDay extends Model
{
    use HasFactory;

    protected $fillable = ['day','from_hour','to_hour','notes'];
    public function costumerDates()
    {

        return $this->hasMany(UserDate::class);
    }
}
