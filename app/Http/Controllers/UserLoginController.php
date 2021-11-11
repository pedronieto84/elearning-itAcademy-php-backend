<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserLoginController extends Controller
{
    public function login(Request $request){

        
        
        $fields = $request->validate([
            'email'=>'required|string|email',
            'password' =>'required|confirmed'
        ]);
        
        //check email
       
        $user = User::where('email',$fields['email'])->first();
       // $user = User::all();
        dd($user);
        //check password
        //if(!$user || !Hash::check($fields['password'],$user->password)){

        //This will return true or false based on whether or not the password matches.
            if(!$user || !Hash::check($fields['password'],$user->password)){
            return response(['status'=>false,'message'=>'invalid email or password'],401);
        }

        //create token
       // $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'status'=>true,
            'message'=>'Login successful!',
            'data' =>[
                'user'=>$user,
                //'token'=>$token
            ]
        ];
        return response($response,201);
    }
}
