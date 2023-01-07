<?php

namespace App\Http\Controllers;

use App\Models\Experince;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Laravel\Passport\Bridge\User;

class ExperinceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description'=>'required|string|max:512'
        ]);
        Experince::query()->create([
            'name' => $request -> name,
            'description' => $request -> description,
            'user_id' => Auth::user()->id
          ]);
        return response()->json([
            'message'=>'success',
            'name of experience'=>$request->name,
            'description'=>$request->description,
        ], 200);
    }

    public function show(Request $request)
    {
        $result = Experince::query()->where('user_id',$request->expert_id)->get(['name','description']);
        return response()->json([
            'message' => 'Success',
        $result
        ],200);


    }

    public function showinfo(Request $request)
    {
        $result = User::query()->where('id',$request->expert_id)->with('Experince')->get(
     [ 'name','phone',] );

        $experince =Experince::query()->where('user_id', $request->expert_id)->get(['name','description']);

        return response()->json([

            'message' => 'success',
          'personal'=>  $result,
           'experince'=> $experince
        ]);

    }
}
