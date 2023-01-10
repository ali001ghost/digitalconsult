<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PayController extends Controller
{
    public function pay(Request $request)
    {
        $result = UserDate::query()
            ->where('id', $request->reservation_id)
            ->where('user_id', Auth::user()->id)
            ->with('consultingUser')
            ->firstOrFail();

        if ($request->price != $result->consultingUser->price) {

            return response()->json(
                [
                    'message' => 'reservation price didnt match with this amount',
                ],
                403
            );
        }


        $user = User::find(Auth::user()->id);
        $bag = $user->bag;
        if ($request->price > $bag) {
            return response()->json([
                'message' => 'you dont have enough money'
            ], 400);
        }
        $user->update([
            'bag' => $bag - $request->price,
        ]);

        $expert = User::find($result->consultingUser->user_id);
        $bag = $expert->bag;
        $expert->update([
            'bag' => $bag + $request->price,
        ]);

        return response()->json([

            'message' => 'Success'

        ], 200);
    }
}
