<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDateController extends Controller
{
    public function store(Request $request)
    {
        $result = User::query()->where('id',Auth::user()->id)->create(
            [  'id' => Auth::user()->id,
              'bag' => $request -> bag,
            
            ]
        );
    }
}
