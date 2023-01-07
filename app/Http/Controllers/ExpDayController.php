<?php

namespace App\Http\Controllers;

use App\Models\ExpDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpDayController extends Controller
{
    public function store(Request $request)
    {
        $result = ExpDay::query()->create([

            'day' => $request->day,
            'from_hour' => $request->from_hour,
            'to_hour' => $request->to_hour,
            'notes' => $request->notes,
            'user_id' => Auth::user()->id,
        ]);
    }



    public function show(Request $request)
    {
        $result = ExpDay::query()->where('user_id',$request->id)->get(['day','from_hour','to_hour','notes'


        ]);
        return $result;
    }



}
