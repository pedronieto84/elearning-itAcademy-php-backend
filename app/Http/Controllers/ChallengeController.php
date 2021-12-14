<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\Reto;
use App\Models\User;


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
    
/**************************************************************************************************************** */        
    public function resolveChallenge(Request $request){

            $idReto1=         $request->input('idReto');
            $usuarioRetado1=  $request->input('usuarioRetado');
            $usuarioQueReta1= $request->input('usuarioQueReta');
            $ganador1=        $request->input('ganador');
    
/*
            $data=[
                'Nº de Reto'      => $idReto1,
                'Usuario Retado'  => $usuarioRetado1,
                'Usuario Retador' => $usuarioQueReta1,
                'ganador'         => $ganador1,
            ];
            return response()->json($data);
*/      
           
        if(Reto::find($idReto1)){    

            $dato= Reto::find($idReto1);
         
//Usuarios y Comprobaciones ...............................................................................  
            $usu_id_Retador= User::find($usuarioQueReta1);
            $usu_id_Retado=  User::find($usuarioRetado1);

             "id_Retador: ".$usuRetador=  $dato->usuarioQueReta;  echo "<br>";
             "id_Retado : ".$usuRetado=   $dato->usuarioRetado;   echo "<br>";
            
                if( $usuRetador <> $usuarioQueReta1 || $usuRetado <> $usuarioRetado1){
                    return response()->json (['existenUsus'=>"Los usuarios no corresponden a este Reto"]);
                }
                if( $usuRetador <> $ganador1 && $usuRetado <> $ganador1){
                    return response()->json (['existeGanador'=>"El ganador no corresponden a este Reto"]);
                }

            
            
//puntos Iniciales........................................................................................        
            "Ptos_Apostados:         ".$puntosApostados= $dato->puntosApostados; echo "<br>";
            "Ptos_iniciales_Retador: ".$puntosInicialesRetador= $usu_id_Retador->userScore; echo "<br>";
            "Ptos_iniciales_Retado:  ".$puntosInicialesRetado = $usu_id_Retado ->userScore; echo "<br>";
           
             $var=array("$puntosInicialesRetador","$puntosInicialesRetado");  
             
             if($puntosInicialesRetador <0 || $puntosInicialesRetado <0){
                return response()->json (['ptosnegativos'=>"Los jugadores no pueden tener puntos negativos"]);
             }
//Sumo puntos al Ganador ..................................................................................        
            if($dato->statusReto==="Pendiente"){                        //comprobar si el reto esta pendiente
                if($ganador1===$usuarioQueReta1){
                    User::where('id', $ganador1)->update(['userScore' => $puntosApostados + $puntosInicialesRetador]);
                         $puntosFinalesRetador   = $puntosApostados + $puntosInicialesRetador;                    
                         $puntosFinalesRetado    = $usu_id_Retado->userScore;                    
                        
                     //"ganador Retador id: ".$usuarioQueReta1." -- Ptos_finales: ".$puntosApostados + $puntosInicialesRetador."<br>";
                     //"perdedor Retado id: ".$usuarioRetado1. " -- Ptos finales: ".$puntosInicialesRetado;  
                }else{
                    User::where('id', $ganador1)->update(['userScore' => $puntosApostados + $puntosInicialesRetado]);
                         $puntosFinalesRetado    = $puntosApostados + $puntosInicialesRetado;                    
                         $puntosFinalesRetador   = $usu_id_Retador->userScore;                    
                        
                     //"ganador Retado: "     .$usuarioRetado1." -- Ptos_finales: ".$puntosApostados + $puntosInicialesRetado."<br>";  
                     //"perdedor Retador id: ".$usuarioQueReta1. " -- Ptos finales: ".$puntosInicialesRetador;  
                }
                
                Reto::where('id', $idReto1)->update(['statusReto' => 'Finalizado']);    //Cambio de Estado

            }else{     
                echo "<br>"."<br>";                                                     
                return response()->json (['finalizado'=>"El reto ya está Finalizado"]);}    
        
                $data=[
                    'Ptos_Apostados:'         => $puntosApostados,
                    'Ptos_iniciales_Retador:' => $puntosInicialesRetador, 
                    'Ptos_iniciales_Retado:'  => $puntosInicialesRetado, 
                    'ganador'                 => $idReto1,
                    'Ptos_finales_Retador:'   => $puntosFinalesRetador,
                    'Ptos_finales_Retado:'    => $puntosFinalesRetado,
                    'Estado del Reto:'        => 'Finalizado',
                ];
                return response()->json($data);
        
        
        }else{
            echo "<br>"."<br>";
            return response()->json (['retoexiste'=>"El reto no existe"]);}    
        }

//................................................................................................

    public function deleteChallenge(Request $request)
    {
        
        $idchallenge= $request->input('retoId');
        $challen = Reto::where('id', '=', $idchallenge);

        if($challen){

            //return response()->json(['error'=> "El reto  existe"]);
            Reto::where('id', $idchallenge)->delete();
            //$challen = Challenge::find($challen)->delete();

            
            return response()->json([
                'estado' => "Eliminado",
                'listadoActual'=> Reto::all()
            ]);
        }else{
            return response()->json(['error'=> "El reto no  existe"]);
        }    
    }





}
