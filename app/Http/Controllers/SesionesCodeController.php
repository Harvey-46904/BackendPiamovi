<?php

namespace App\Http\Controllers;

use App\Models\Sesiones_code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
class SesionesCodeController extends Controller
{
 
    public function store($user_id,$code)
    {
        $user_opt = new Sesiones_code([
            'usuario_id' => $user_id,
            'otp_code' => Hash::make ($code)     
        ]);
        $user_opt->save();
        return true;
    }
    public function verificar_otp(Request $request){
        //validar primero el telefono en cockie con el del usuario
        $usuario_encontrado=DB::table("sesiones_codes")
      
        ->join("usuarios","sesiones_codes.usuario_id","=","usuarios.id")
        ->where(
            [
                "usuarios.telefono"=>$request->telefono,
            ]
            )
        ->latest('sesiones_codes.created_at')
        ->first();

        if($usuario_encontrado && Hash::check($request->code_otp, $usuario_encontrado->otp_code)){
           return response(["data"=>"Codigo OTP correcto"]);
        }else{
            return response(["data"=>"Codigo OTP incorrecto"]);
        }
              
    }

   
}
