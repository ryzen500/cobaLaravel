<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function register(Request $request){


        $validatedData =$request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:5'
        ]);


        $user =User::create([
            'name'=> $validatedData['name'],
            'email'=> $validatedData['email'],
            'password'=> Hash::make($validatedData['password']),
        ]);

        return $user;
    }


    public function login(Request $request){

        // Input Validation
        $validatedData = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string|min:5',
        ]);

        // Kondisi 
        if (!Auth::attempt([
            'email'=>$validatedData['email'],
            'password'=>$validatedData['password']
        ])) {
            # kondisi salah returnnya adlah berikut
            return response()->json([
                'message'=> 'Invalid Email Or Password'
            ]);
        }

        // Object User
        $user = User::where('email', $request['email'])->firstOrFail();

        // kalau berhasil, generated token

        $token = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer'
        ]);

    }


    public function changePassword(Request $request){
        $validatedData = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string',
            'newpassword'=>'required|string',

        ]);

        if (!Auth::guard('web')->attempt([
            'email'=>$validatedData['email'],
            'password'=>$validatedData['password']])) {
            
                return response()->json([
                    'message'=>'invalid email or password'
                ],401);
            }

        $user = User::where('email',$validatedData['email'])->firstOrFail();

        $user->tokens()->delete();

        $user->password=Hash::make($validatedData['newpassword']);
        $user->save();

        return response()->json([
            'message'=>'password was changed'
        ]);
    } 

    public function logout(Request $request){
        $user= User::where('email',$request['email'])->firstOrFail();

        // Delete Token User Using Object
        $user->tokens()->delete();

        return response()->json([
            'message'=>'token sudah dihapus'
        ]);
    }
}
