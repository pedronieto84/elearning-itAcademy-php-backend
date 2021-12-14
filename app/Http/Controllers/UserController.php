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
        'password' => 'required|min:5|max:10'
    ],
    [
        'required' => 'Missing :attribute input',
        'email' => 'Email format invalid',
        'unique' => 'This email is already existing',
        'userName.min' => 'User Name too short',
        'password.min' => 'Password must be at least 5 characters long',
        'password.max' => 'Password must be 10 characters long at maximum'
    ]);

    //En cas d'error, retorna l'error
    if ($validator->fails()){
    return response()->json([
        'error' => $validator->errors()
    ], 422);
    }
    
    //Creació d'usuari
    $user = User::create([
        'userName' => $request->userName,
        'email' => $request->email,
        'password' => $request->password,
        'userScore' => 0
    ]);

    //En cas de que funcioni, retorna l'usuari
    return $user;
}

//..............................................................................................................
    public function getusers(Request $request){
        
        $email= $request->input('email');

        if($email === "pedro.nieto.sanchez@gmail.com"){
            return response()->json(['Usuarios' => User::all()]);
        }else{
            return response()->json([
                'message'=> "email : (".$email." ) no autorizado para ver lista de usuarios",
            ]);            
        }

    }

//..............................................................................................................
    public function deleteUser(Request $request)
    {
        
        
        $idUser= $request->input('id');
        $user = User::find($idUser);

        if($user){    
            $user = User::find($idUser)->delete();
            return response()->json([
                'estado' => "Eliminado",
                'listado actual'=> User::all()
            ]);
        }else{
            return response()->json(['error'=> "El usuario no  existe"]);
        }    
    }



}

?>