<?php

namespace App\Http\Controllers;

use App\Models\Consulting_User;
use App\Models\ExpDay;
use App\Models\UserDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDateController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'consulting_id' => 'required|exists:consultings,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $expconsulting = Consulting_User::query()
            ->where('consulting_id', $request->consulting_id)
            ->where('user_id', $request->user_id)->firstOrFail('id');


        $result = UserDate::query()->create(
            [
                'user_id' =>Auth::user()->id,
                'consulting_user_id' => $expconsulting->id,
                'date' => $request->date,
            ]
        );
        return response()->json([
            'message' => 'success',
        ], 200);
    }

    public function show(Request $request)
    {
        //user dates
        // $userdate = UserDate::query()
        // ->where('user_id',Auth::user()->id)
        // ->get();
        // return response()->json([

        //     'message' => 'success',
        //     'data' =>  $userdate

        // ]);
        ///////////////
        //expert dates
        $expertDates = Consulting_User::where('user_id', Auth::user()->id)
            ->with('userdate')
            ->get();

        return $expertDates;
        ////////////////





    }

    public function reservation(Request $request)
    {
        $result = DB::table('exp_days')
            ->join('consulting_users', 'consulting_users.user_id', 'exp_days.user_id')
            ->join('user_dates', 'user_dates.consulting_user_id', 'consulting_users.id')
            ->where('exp_days.user_id', $request->exp_id)
            ->where('consulting_users.consulting_id', $request->consulting_id)
            ->get();

        return $result;

    }
}
