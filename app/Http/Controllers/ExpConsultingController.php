<?php

namespace App\Http\Controllers;

use App\Models\Consulting;
use App\Models\Consulting_User;
use App\Models\ExpConsulting;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpConsultingController extends Controller
{
    // public function store(Request $request)
    // {
    //     $result = ExpConsulting::query()->where('id',ExpConsulting::user()->id)->create([
    //         'Co' => $request -> Consulting_name
    //       ]);
    // }


    // add consulting to the login expert
    public function store(Request $request){

        $result = Consulting_User::query()->create([
            'user_id'=>Auth::user()->id,
            'consulting_id'=>$request->consulting_id,
            'price'=>$request->price
        ]);
        return response()->json([
            'message'=>'success',
            'user_id'=>Auth::user()->id,
            'consulting_id'=>$request->id
        ]);
    }

    // get all the experts to the certain consult
    public function getExperts(Request $request){
        $cons=Consulting_User::query()
        ->with('user')
        ->where('consulting_id',$request->consulting_id)
        ->get();

        return response()->json([
            'message'=>'success',
           'data' =>$cons]) ;
    }
}
