<?php

namespace App\Http\Controllers;

use App\User;
use Mail;
use App\Mail\Correo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\EmergencyCallReceived;
//use App\Mail\SendMail;

class TokensController extends Controller
{
    /**
     * Metodo que permite iniciar sesion
     */
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Error en las credenciales',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $token = JWTAuth::attempt($credentials);
            if ($token) {
                return response()->json([
                    'success' => true,
                    'code' => 1,
                    'message' => 'Operacion realizada con exito',
                    'data' => ['token'=>$token,
                               'usuario' =>User::where('email', $credentials['email'])->get()->first()],
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'code' => 3,
                    'message' => 'Error en las credenciales',
                    'data' => ['error'=>$validator->errors()]
                ], 401);
            }
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 4,
                'message' => 'Error al solicitar peticiones a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que permite refrescar un token
     */
    public function refreshToken(){
        $token = JWTAuth::getToken();
        try {
            $token = JWTAuth::refresh($token);
            return response()->json([
                'success' => true,
                'code' => 1,
                'message' => 'Operacion realizada con exito',
                'data' => ['token'=>$token],
            ], 200);
        } catch (TokenExpiredException $ex) {
            // We were unable to refresh the token, our user needs to login again
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Necesita iniciar secion otra vez, porfavor (Expirado)!',
                'data' => null
            ], 422);
        } catch (TokenBlacklistedException $ex) {
            // Blacklisted token
            return response()->json([
                'success' => false,
                'code' => 3,
                'message' => 'Necesita iniciar secion otra vez, porfavor (Lista negra)!',
                'data' => null
            ], 422);
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 4,
                'message' => 'Error al solicitar peticiones a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }

    }

    /**
     * Metodo que permite cerrar sesion
     */
    public function logoutToken()
    {
        //  $this->validate($request, ['token' => 'required']);
        $token = JWTAuth::getToken();
        try {
            $token = JWTAuth::invalidate($token);
            return response()->json([
                'success' => true,
                'code' => 1,
                'message' => "Has cerrado la sesión con exito",
                'data' => null
            ], 200);
        //este catch permite responder directamente que problemas en la peticion de Token
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => "No se a podido cerrar la sesión, por favor volver a intentar",
                'data' => null
            ], 422);
        //este catch permite responder directamente que problemas en la peticion SQL
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 3,
                'message' => 'Error al solicitar peticiones a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que se encarga en recuperar la contraseña
     */
    public function restartPassword(Request $request){
        $credentials = $request->only('email');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Error en el tipo de dato',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        //$user = User::where('emails.email', $credentials['email'])->get()->first(); 
        //$receivers = Receiver::pluck('email');
        //Mail::to("xebaelvemgador@gmail.com")->send(new EmergencyCallReceived());

        try{
            \Mail::send('mails.test', [], function ($mail) {
                $mail->from('sdiUtalca@gmail.com', 'Sistema de gestion de ayudantes');
                $mail->to('sdiUtalca@gmail.com', 'ayuda')->subject('Test');
            });
         //este catch permite responder directamente que problemas en la peticion MAIL
        }catch(\Exception $e){
             return response()->json(['Confirmacion' => $e], 500);
        }
        return response()->json(['Confirmacion' => 'Se a mandado el correo exitosamente'], 200);
       
        /* 
        $datos = array(
            'titulo' => "Recuperacion de clave del sistema de gestion de ayudantes",
            'contenido' => "Su clave es: ".$user['email'],
        );
        Mail::send('notificacion', $datos, function ($mail) {
            $mail->to('xebaelvemgador@gmail.com')->subject('Test');
          });
        */

        /*
        if($user==null){
            //aca se manda el mail
            return response()->json(['Confirmacion' => 'Se a mandado el correo exitosamente'], 200);
        }else {
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Error en las credenciales',
                'errors' => $validator->errors()], 401);
        }
        */
    }
}