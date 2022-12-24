<?php

namespace App\Http\Controllers;

use App\Models\User;
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

}
