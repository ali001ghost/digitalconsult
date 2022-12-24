<?php

namespace App\Http\Controllers;

use App\Models\ExpConsulting;
use Illuminate\Http\Request;

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
        $cons=Consulting::query()->where('name',$request->name)->first('id');
        $result = ExpConsulting::query()->create([
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
    public function getExpert(){

    }
}
