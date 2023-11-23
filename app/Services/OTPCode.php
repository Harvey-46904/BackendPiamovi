<?php

namespace App\Services;
use Twilio\Rest\Client;
class OTPCode
{

    public function enviar_mensaje($nombre,$telefono,$mensaje){
        $phoneNumber =$telefono;
        $message ="Hola ".$nombre." Tu codigo OTP es: ".$mensaje;

        $twilioSid = config('services.twilio.sid');
        $twilioAuthToken = config('services.twilio.auth_token');
        $twilioPhoneNumber = config('services.twilio.phone_number');

        $twilio = new Client($twilioSid, $twilioAuthToken);

        try {
            $twilio->messages->create(
                $phoneNumber,
                [
                    'from' => $twilioPhoneNumber,
                    'body' => $message,
                ]
            );

            return "Mensaje Enviado";
        } catch (\Exception $e) {
            return "ERROR Enviado";
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function generar_codigo_otp(){
        $longitud=6;
        $caracteres = '0123456789';
        $codigo = '';
    
        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }
    
        return $codigo;
    }

    //falta funcion y tabla para guardar el codgio


    public function enviar_codigo_con_sms($telefono,$nombre){
        $codigo=self::generar_codigo_otp();
        $enviar_mensaje=self::enviar_mensaje($nombre,$telefono,$codigo);
        return $codigo;
    }
  
}
