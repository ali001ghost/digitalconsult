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

    public function showall(Request $request)
    {
        $result = Consulting::query()->get();
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
