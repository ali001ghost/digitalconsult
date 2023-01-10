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
use Illuminate\Support\Facades\validator;
//use Illuminate\Validation\Validator;


class AuthController extends Controller
{
    public function register(Request $request){
        // $request->validate(
        //              [
        //                  'name'=>['required','string','max:55'],
        //                  'phone'=>['required','string','unique:users'],
        //                 'role'=>['required','in:costumer,Expert'],
        //                 'password'=>['required','confirmed' ]
        //              ]
        //          );


        $validator =Validator::make($request->all() ,[
            'name'=>['required','string','max:55'],
                          'phone'=>['required','string','unique:users'],
                          'role'=>['required','in:Customer,Expert'],
                            'password'=>['required','confirmed' ]
        ]);
        if($validator->fails()  ){
                        return response()->json([
                            'mesaage'=>'an error occurred ',
                            'error'=>$validator->errors()->all()
                        ],422);
                   }
                $user = User::query()->create([
                    'name'=>$request->name,
                    'phone'=>$request->phone,
                    'password'=>Hash::make($request->password),
                    'role' => $request->role
                ]);

                $token = $user->createToken('user');

                $data['user']=$user;
                $data['type']='Bearer';
                $data['token']=$token->accessToken ;

                return response()->json([
                    'mesaage'=>'successfuly',
                    'data'=>$data
                ],200);
            }


    public function login(Request $request){
        $credentials = request(['phone', 'password']);
        if (!Auth::attempt($credentials)){
            return response()->json([
                'message'=>'an error occured',
                'error'=> ' the phone or the password is wrong'
            ],422);
        }

        $user = $request->user();
        $token=$user->createToken('user');

        $data['user']=$user;
        $data['type']='Bearer';
        $data['token']=$token->accessToken;

        return response()->json( [
           'message'=>'succsse',
           'data'=>$data

        ], 200);

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


