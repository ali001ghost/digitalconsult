<?php

namespace App\Http\Controllers;

use App\Models\Consulting;
use App\Models\Consulting_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultingController extends Controller
{
     // add consulting to the login expert
     public function store(Request $request){
        $cons=Consulting::query()->where('id',$request->id)->first('id');
        $result = Consulting_User::query()->create([
            'user_id'=>Auth::user()->id,
            'consulting_id'=>$cons->id
        ]);
        return response()->json([
            'message'=>'success',
            'user_id'=>Auth::user()->id,
            'consulting_id'=>$cons
        ]);
    }
        // get all the experts to the certain consult
  public function getExperts(Request $request){
    $id=$request->consulting_id;
    $experts=Consulting::with('experts')->where('id',$id)->get();
    return response()->json([
        'message'=>'success',
        'data'=>$experts
    ],200);

  }

}



