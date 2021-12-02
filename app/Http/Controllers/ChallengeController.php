<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//mod
use App\Models\User;
use App\Models\Reto;

class ChallengeController extends Controller
{
    public function registerChallenge(Request $request) {

        // === Obtener data pasada
        //return "Hello world!!!";
        //dd($request);
        $data = ( $request->json()->all() );
        $usuarioQueReta = $data["usuarioQueReta"];
        $usuarioRetado = $data["usuarioRetado"];
        $puntosApostados = $data["puntosApostados"];
        $temario = $data["temario"];
        //dd ($data["usuarioRetado"]);

        // === Validar que los 2 usuarios existen
        $user1 = User::where("id", $usuarioQueReta)->count();
        if ($user1){
            //return "user 1 existe";
        } else {
            return "user 1 NO existe";
        }
        $user2 = User::where("id", $usuarioRetado)->count();
        if ($user2){
            //return "user 1 existe";
        } else {
            return "user 2 NO existe";
        }

        // === Validar que usuario que reta y el retado son diferentes
        if ($usuarioQueReta <> $usuarioRetado) {
            //return "usuarios diferentes";
        } else {
            return "usuarios iguales";
        }
        
        // === Validar que los 2 usuarios tienen al menos 1 punto
        $user1 = User::where("id", $usuarioQueReta)->get(['userScore'])->first();
        $user1Score = $user1['userScore'];
        if ($user1Score > 0){
            //return "El usuario tiene puntos" . $user1Score;
        } else {
            return "El usuario 1 NO tiene puntos";
        }
        $user2 = User::where("id", $usuarioRetado)->get(['userScore'])->first();
        $user2Score = $user2['userScore'];
        if ($user2Score > 0){
            //return "El usuario tiene puntos" . $user1Score;
        } else {
            return "El usuario 2 NO tiene puntos";
        }

        // === Validar que el temario existe 
        if (strlen($temario) <1 ){
            return "El temario No Existe";
        }

        //=== Genera new reg tbl retos
        //add registro
        $reto = Reto::create([
            'usuarioQueReta' => $usuarioQueReta,
            'usuarioRetado' => $usuarioRetado,
            'puntosApostados' => $puntosApostados,
            'temario' => $temario,
            'statusReto' => 'pendiente',
          ]);
          
        // === Quitar del que reta y retado los puntos
        //update registro
        //dd(getType($usuarioQueReta));
        $usu = User::where("id", $usuarioQueReta)->get(['userScore'])->first();
        $newUserScore = $usu['userScore'] -1;

        //dd($newUserScore);

        $usu->userScore = $newUserScore;
        $usu->save();


        return "ok";
        
    }
}
