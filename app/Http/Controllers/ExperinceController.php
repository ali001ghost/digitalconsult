<?php

namespace App\Http\Controllers;

use App\Models\Experince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Bridge\User;

class ExperinceController extends Controller
{
    public function store(Request $request)
    {
        Experince::query()->create([
            'name' => $request -> name,
            'description' => $request -> description,
            'user_id' => Auth::user()->id
          ]);

        return response()->json('success', 200);
    }
}
