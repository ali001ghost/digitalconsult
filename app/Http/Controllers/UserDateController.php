<?php

namespace App\Http\Controllers;

use App\Models\Consulting_User;
use App\Models\UserDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDateController extends Controller
{
    public function store(Request $request)
    {
        $expconsulting=Consulting_User::query()
        ->where('consulting_id',$request->consulting_id)
        ->where('user_id',$request -> user_id)->firstOrFail('id');


        $result = UserDate::query()->create(
            [  'user_id' => $request->user_id,
                'consulting_user_id' => $expconsulting -> id,
                'date'=> $request -> date,
            ]
        );
        return response()->json([
            'message' => 'success',
        ], 200);
    }

    public function show(Request $request)
    {
        $userdate = UserDate::query()->where('user_id',Auth::user()->id)->get(['consulting_user_id','date']);
        return response()->json([

            'message' => 'success',
            $userdate

        ]);
    }
}
