<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;


class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate(
                     [
                         'name'=>['required','string','max:55'],
                         'phone'=>['required','string','unique:users'],
                        'role'=>['required','in:costumer,Expert'],
                        'password'=>['required','confirmed' ]
                     ]
                 );
                $user = User::query()->create([
                    'name'=>$request->name,
                    'phone'=>$request->phone,
                    'password'=>Hash::make($request->password),
                    'role' => $request->role
                ]);

                $token = $user->createToken('user');

                $data['user']=$user;
                $data['type']='Bearer';
                $data['token']=$token->accessToken;

                return response()->json($data,200);
            }


    public function login(Request $request){
        $credentials = request(['phone', 'password']);
        if (!Auth::attempt($credentials)){
            throw new AuthenticationException();
        }

        $user = $request->user();
        $token=$user->createToken('user');

        $data['user']=$user;
        $data['type']='Bearer';
        $data['token']=$token->accessToken;

        return response()->json($data, 200);

    }

    public function logout(Request $request){
        $request->user()->token()->delete();
        return response()->json([
            'message'=>"logged out successfully"

        ],200);
    }

    public function deleteUser(User $user){
        if ($user->id == Auth::id()) {
            $user->delete();
        }
    }
}


