<?php

namespace App\Http\Controllers;

use App\Models\Consulting_User;
use App\Models\ExpDay;
use App\Models\User;
use App\Models\UserDate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            ->where('user_id', $request->user_id)->firstOrFail();

        $exp = Consulting_User::query()
            ->where('user_id', $request->user_id)
            ->whereHas('userdate', function ($q) use ($request) {
                $q->whereBetween('date', [Carbon::parse($request->date)->subMinutes(15), $request->date]);
            })
            ->exists();

        if ($exp) {
            return response()->json([
                'message' => 'this date already reserved',
            ], 400);
        }

        $result = UserDate::query()->create(
            [
                'user_id' => Auth::user()->id,
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
        $result = User::where('id', $request->exp_id)
            ->with('consultings',function($q){
                $q->with('expResevedDate');
            })
            ->with('expDays')
            ->get();

        return response()->json([
            'message' => 'success',
            'data' =>  $result
        ]);
    }
}
