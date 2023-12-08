<?php

namespace App\Http\Controllers;
use App\Http\Controllers\SesionesCodeController;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use App\Services\OTPCode;
use Illuminate\Support\Facades\Hash;
use DB;
class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuarios::all();
        return response()->json($usuarios);
    }

    public function store(Request $request)
    {
       // return response(["data"=>$request->all()]);
        $request->validate([
            'nombres_completos' => 'required|string',
            'correo' => 'required|email|unique:usuarios',
            'telefono' => 'required|string',
            'pin' => 'required|string',
            'fecha_nacimiento' => 'required|string',
            'genero' => 'required|string',
            'acuerdos' => 'required|string',
        ]);


    
        $usuario = new Usuarios([
            'nombres_completos' => $request->input('nombres_completos'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'pin' =>Hash::make ($request->input('pin')),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'genero' => $request->input('genero'),
            'acuerdos' => $request->input('telefono'),
        ]);

        $usuario->save();

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuarios no encontrado'], 404);
        }

        return response()->json($usuario);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuarios no encontrado'], 404);
        }

        $request->validate([
            'nombres_completos' => 'required|string',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuario->id,
            'telefono' => 'required|string|unique:usuarios,telefono'. $usuario->id,
            'pin' => 'required|string',
        ]);

        $usuario->nombre = $request->input('nombres_completos');
        $usuario->correo = $request->input('correo');
        $usuario->telefono = $request->input('telefono');
        $usuario->saldo = $request->input('pin');

        $usuario->save();

        return response()->json($usuario, 200);
    }

    public function destroy($id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuarios no encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuarios eliminado'], 200);
    }

    public function Enviar_codigo_otp(Request $request,OTPCode $otp){
        $telefono=$request->telefono;
        return response(["message"=>$otp->enviar_codigo_con_sms($telefono)]);
    }

    public function Login_usuario(Request $request,OTPCode $otp){
        $usuario_encontrado=DB::table("usuarios")
        ->where(
            [
                "telefono"=>$request->telefono,
            ]
            )
        ->first();


        if($usuario_encontrado && Hash::check($request->pin, $usuario_encontrado->pin)){
            //los datos existen envia el codigo 

            //obtener el codigo que envie al cel
            $codigo_otp=$otp->enviar_codigo_con_sms($usuario_encontrado->telefono,$usuario_encontrado->nombres_completos);
            //funcion para guardar un codigo otp en la bd 
            $guardar_otp= new SesionesCodeController();
           $resultado=  $guardar_otp->store($usuario_encontrado->id,$codigo_otp);
           return response(["data"=>"Codigo OTP enviado","codigo"=>2]);
        }else{
            return response(["data"=>"error en algo","codigo"=>1]);
        }

        return response(["data"=>$usuario_encontrado,"oass"=>Hash::make ($request->pin)]);
    }
}
