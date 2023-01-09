<?php

namespace App\Http\Controllers;

use App\Models\Consulting;
use App\Models\Consulting_User;
use App\Models\ExpConsulting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultingController extends Controller
{
    // add consulting to the login expert
    public function store(Request $request)
    {
        $cons = Consulting::query()->where('id', $request->id)->first('id');
        $result = Consulting_User::query()->create([
            'user_id' => Auth::user()->id,
            'consulting_id' => $cons->id
        ]);
        return response()->json([
            'message' => 'success',
            'user_id' => Auth::user()->id,
            'consulting_id' => $cons
        ]);
    }

    public function showall(Request $request)
    {
        $result = Consulting::query()->get(['id', 'name']);
        return response()->json([
            'message' => 'success',
            'data' => $result
        ], 200);
    }

    // get all the experts to the certain consult
    public function getExperts(Request $request)
    {
       

        $cons=Consulting_User::query()
        ->with('consulting')
        ->where('user_id',$request->expert_id)->get();

        return response()->json([
            'message'=>'success',
           'data' =>$cons]) ;
    }

}
