<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    public function login(Request $request){

        
        
       
        
        //check email
        $datoS[]='';
       
       $datos = json_decode($request->getContent(),true); //dd($datos);
        foreach($datos as $dato){
            $datoS[] = $dato; 
        }
       
        $user = User::where('email',$datoS[1])->first();
       

        //This will return true or false based on whether or not the password matches.
            if(!$user || !Hash::check('password',$datoS[2])){
            return response(['message'=>'invalid email or password'],401);
        }

        //create token
       

        $response = [
        'user'=>$user->email,'password' => $user->password   
        ];
        return response($response,201);
}
}
