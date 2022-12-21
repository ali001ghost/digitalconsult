<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;
    protected $fillable =['city','country','street'];

    public function User()
    {

        return $this->belongsTo(User::class);
    }
}
