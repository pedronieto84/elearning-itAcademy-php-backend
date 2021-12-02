<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;



class ChallengeController extends Controller
{
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
