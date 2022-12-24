<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpConsulting extends Model
{
    use HasFactory;

    protected $fillable=['user_id','consulting_id','price'];
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Consulting()
    {
        return $this->belongsTo(Consulting::class);
    }
}
