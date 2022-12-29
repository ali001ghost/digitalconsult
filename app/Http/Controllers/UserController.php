<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Consulting;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function storeWallet(Request $request)
    {
        $result = User::query()->where('id',Auth::user()->id)->create(
            [  'id' => Auth::user()->id,
              'bag' => $request -> bag,
              'name' => Auth::user()->name,
              'phone' => Auth::user()->phone,
              'role' => Auth::user()->role,
              'password' => Auth::user()->password,
            ]
        );

    }

    public function updateWallet(Request $request)
    {
        $result = User::query()->where('id',Auth::user()->id)->update(
            [
            //   'user_id' => Auth::user()->id

            'bag' => $request -> bag
            ]
        );

    }

    public function uploadImg(Request $request ){
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);
        $image = $request->file('image');
        if($request->hasFile('image')){
            $image = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $image);
         }
         $user = User::where('id',Auth::user()->id)->update(['image'=>$image]);
         return response ()->json([
            'message'=>'successfully',
            'user'=>$user,
            'image'=>$image
         ]);

    }

    // search
    public function searchForExpert(Request $request){
        $query=User::query()->select('id','name','image','role' )->orderBy('id');
        $columns=['name'];
        foreach($columns as $column){
            $query->orWhere($column,'LIKE','%'.$request->name.'%')->where('role','Expert');
        }
        if($query->count()){
            $expert=$query->get();
            return response() ->json([
                'message'=>'successe',
                'name'=>$expert
            ],200);
        }
        else return response() ->json([
            'message'=>'No Results Found'
        ],422);

    }

    public function searchForCons(Request $request){
        $query=Consulting::query()->select('id','name' )->orderBy('id');
        $columns=['name'];
        foreach($columns as $column){
            $query->orWhere($column,'LIKE','%'.$request->name.'%');
        }
        if($query->count()){
            $cons=$query->get();
            return response() ->json([
                'message'=>'successe',
                'name'=>$cons
            ],200);
        }
        else return response() ->json([
            'message'=>'No Results Found'
        ],422);
    }

}
