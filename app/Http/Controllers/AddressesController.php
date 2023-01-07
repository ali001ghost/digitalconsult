<?php

namespace App\Http\Controllers;


use App\Models\Addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;

class AddressesController extends Controller
{
    public function store(Request $request)
    {
        $result = Addresses::query()->create([
 'user_id' => Auth::user()->id,
            'city' => $request->city,
            'country' => $request->country,
            'street' => $request->street,


        ]);
    }
    public function show(Request $request)
    {
        $result = Addresses::query()->where('user_id', $request->expert_id)->get(['city','country','street']);
        return response()->json([
      'message'=>'Success',
      $result


        ],200);
    }

}
