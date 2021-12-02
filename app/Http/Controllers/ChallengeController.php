<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\User;

//mod
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
    
    public function getChallenge(Request $request, $id){
        

        if(Challenge::find($id)){                               //comprobar que existe Reto
    
            $dato= Challenge::find($id);
           
    
            
//Usuarios...............................................................................................                
            $usuRetador=  $dato->usuarioQueReta;  
            $usuRetado=   $dato->usuarioRetado;
            $usu_id_Retador= User::find($usuRetador);
            $usu_id_Retado=  User::find($usuRetado);
    
    
//puntos Iniciales........................................................................................        
            $puntosApostados= $dato->puntosApostados;
            $puntosInicialesRetador= $usu_id_Retador->userScore;
            $puntosInicialesRetado = $usu_id_Retado ->userScore;
            $respRetador= substr_count($dato->arrayRespuestasRetador,",");
            $respRetado = substr_count($dato->arrayRespuestasRetado,",");
     
          
//Ganador ................................................................................................        
    
        if($dato->statusReto==="Pendiente"){
    
            if($respRetador > $respRetado){
                User::where('id', $usuRetador)->update(['userScore' => $puntosApostados + $puntosInicialesRetador]);  
            }else{
                User::where('id', $usuRetado)->update(['userScore' => $puntosApostados + $puntosInicialesRetado]);  
            }
    
//Cambio de Estado .......................................................................................        
            
            Challenge::where('id', $id)->update(['statusReto' => 'Finalizado']);
    
            return response()->json([
                'puntos Apostados' => $puntosApostados,
                'puntos_Iniciales' => $usu_id_Retador->name.': '.$puntosInicialesRetador,
                'puntos.Iniciales' => $usu_id_Retado->name.': '.$puntosInicialesRetado,
                'Reto' => Challenge::find($id),
                'Usuario Retador' => User::where('id',$usuRetador)->get(),
                'Usuario Retado'  => User::where('id',$usuRetado)->get(),
                
            ]);
        }else{
            return "El reto ya está Finalizado";
        }    
    
        }else{
            return "El Reto no existe";
        }
        }


    
}
