<?php

namespace App\Http\Controllers;

use App\Models\Consulting;
use App\Models\ExpConsulting;
use App\Models\Consulting;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
=======
use Illuminate\Support\Facades\Auth;

>>>>>>> ebec3537290d3f6726ea9f487d48e930dfb70f78
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
        $cons=Consulting::query()->where('id',$request->id)->first('id');
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
    public function getExperts(Request $request){
        $cons=Consulting::query()->where('name',$request->name)->first('id');
           return $cons;
    }
}
