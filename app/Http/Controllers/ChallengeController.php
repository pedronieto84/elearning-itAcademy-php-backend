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
            //return "user 1 NO existe";
            return response()->json (['status' => 'user 1 don t exist'], 409);  
        }
        $user2 = User::where("id", $usuarioRetado)->count();
        if ($user2){
            //return "user 1 existe";
        } else {
            //return "user 2 NO existe";
            return response()->json (['status' => 'user 2 don t exist'], 409);  
        }

        // === Validar que usuario que reta y el retado son diferentes
        if ($usuarioQueReta <> $usuarioRetado) {
            //return "usuarios diferentes";
        } else {
            //return "usuarios iguales";
            return response()->json (['status' => 'user 1 and user 2 are the same'], 409);  
        }
        
        // === Validar que los 2 usuarios tienen al menos 1 punto
        $user1 = User::where("id", $usuarioQueReta)->get(['userScore'])->first();
        $user1Score = $user1['userScore'];
        if ($user1Score > 0){
            //return "El usuario tiene puntos" . $user1Score;
        } else {
            //return "El usuario 1 NO tiene puntos";
            return response()->json (['status' => 'user 1 don t have points available'], 409);  
        }
        $user2 = User::where("id", $usuarioRetado)->get(['userScore'])->first();
        $user2Score = $user2['userScore'];
        if ($user2Score > 0){
            //return "El usuario tiene puntos" . $user1Score;
        } else {
            // return "El usuario 2 NO tiene puntos";
            return response()->json (['status' => 'user 2 don t have points available'], 409);  
        }

        // === Validar que el temario existe 
        if (strlen($temario) <1 ){
            //return "El temario No Existe";
            return response()->json (['status' => 'temario don t exist'], 409);  
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
          
        // === Quitar del que reta y retado los puntos apostados
        //update usu que reta
        $usuUpdt = User::where("id", $usuarioQueReta)->get()->first();
        $newUserScore = ($usuUpdt->userScore) - 1;
        $usuUpdt->userScore = $newUserScore;
        $salida = $usuUpdt->save();

        //update usu que retado
        $usuUpdt = User::where("id", $usuarioRetado)->get()->first();
        $newUserScore = ($usuUpdt->userScore) - 1;
        $usuUpdt->userScore = $newUserScore;
        $salida = $usuUpdt->save();

        return response()->json (['status' => 'successful'], 200);    
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
