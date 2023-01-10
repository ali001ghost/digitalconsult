<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Consulting;
use App\Models\Consulting_User;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function updateWallet(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->update([
            'bag' => $user->bag + $request->amount
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function uploadImg(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $image);
        }
        $user = User::where('id', Auth::user()->id)->update(['image' => $image]);
        return response()->json([
            'message' => 'successfully',
            'user' => $user,
            'image' => $image
        ]);
    }

    // search
    public function searchForExpert(Request $request)
    {
        $query = User::query()
            ->where('name', 'LIKE', '%' . $request->name . '%')
            ->get();

        return response()->json([
            'message' => 'successe',
            'name' => $query
        ], 200);
    }

    public function searchForCons(Request $request)
    {
        $query = Consulting::query()
            ->where('name', 'LIKE', '%' . $request->name . '%')
            ->get();

        return response()->json([
            'message' => 'successe',
            'name' => $query
        ], 200);
    }

    public function expReservation()
    {
        $result = User::where('id', Auth::user()->id)
            ->with('consultings', function ($q) {
                $q->whereHas('expResevedDate')
                    ->with('expResevedDate');
            })
            ->get();

        return response()->json([
            'message' => 'success',
            'data' =>  $result
        ]);
    }
}
