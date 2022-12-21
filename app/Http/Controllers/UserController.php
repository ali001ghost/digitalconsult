<?php

namespace App\Http\Controllers;

use App\Models\User;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateWallet(Request $request)
    {
        $result = User::query()->where('id',Auth::user()->id)->update(
            [
            //   'user_id' => Auth::user()->id

            'bag' => $request -> bag
            ]
        );

    }
}
