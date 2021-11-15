<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
   public function register (Request $request) {

    //Validació de dades
    $validator = Validator::make($request->only('userName','email','password'), [
        'userName' => 'required|min:4',
        'email'=>'required|email|unique:App\Models\User,email',
        'password' => 'required|min:6'
    ],
    [
        'required' => 'Missing :attribute input',
        'email' => 'Email format invalid',
        'unique' => 'This email is already existing',
        'password.min' => 'Password must be 6 characters long'
    ]);

    //En cas d'error, retorna l'error
    if ($validator->fails()){
    return response()->json([
        'error' => $validator->errors()
    ], 422);
    }
    
    //Creació d'usuari
    $user = User::create([
        'userName' => $validator->userName,
        'email' => $validator->email,
        'password' => $validator->password
    ]);

    //En cas de que funcioni, retorna l'usuari
    return $user;
   }
}





?>