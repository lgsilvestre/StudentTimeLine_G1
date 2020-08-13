<?php

namespace App\Http\Controllers;

use App\User;
use App\Estudiante;
use App\Curso;
use App\InstanciaCurso;
use App\Escuela;
use Mail;
use App\Mail\Correo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\EmergencyCallReceived;
use \App\Mail\SendMail;


class SolicitudDeAyudanteController extends Controller
{

    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    public function __construct()
    {
        $this->middleware(['permission:enviar solicitud'], ['only' => 'enviar']);
    }

    /**
     * Metodo que se encarga de mandar un email
     */
    public function enviar(Request $request){
        $entradas = $request->only('estudiante', 'curso', 'nota', 'meses', 'horas');
        $validator = Validator::make($entradas, [
            'estudiante' => 'required|numeric',
            'curso' => 'required|numeric',
            'nota' => 'required|numeric',
            'meses' => 'required|numeric',
            'horas' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 2,
                'message' => 'Error en el tipo de dato',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $credenciales = JWTAuth::parseToken()->authenticate();
            $estudiante = Estudiante::Where('id',  $entradas['estudiante'])->first();
            $instanciaCurso = InstanciaCurso::where('id', $entradas['curso'])->first();
            $curso = Curso::where('id', $instanciaCurso['curso'])->first();
            $secretarias=User::Where('rol', 'secretaria de escuela')->where('escuela', $estudiante['escuela'])->get();
            $escuela = Escuela::where('id', $estudiante['escuela'])->first();
         
            $details = array(
                'opcion' => 2,
                'nombreProfesor' => $credenciales->nombre,
                'escuelaProfesor' => $credenciales->getEscuela->nombre,
                'escuelaEncargado' => $credenciales->getEscuela->nombre,
                'escuelaEstudiante' => $escuela['nombre'],
                'estudiante' => $estudiante['nombre_completo'],
                'rut' => $estudiante['rut'],
                'matricula' => $estudiante['matricula'],
                'seccion' => $instanciaCurso['seccion'],
                'curso' => $curso['nombre'],
                'nota' => $entradas['nota'],
                'meses' => $entradas['meses'],
                'horas' => $entradas['horas']
            );
         
            foreach($secretarias as $secretaria){
                \Mail::to($secretaria->email)->send(new SendMail($details));
            }
            return response()->json([
                'success' => true,
                'code' => 1,
                'message' => 'Se a mandado el correo exitosamente',
                'data' => null
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'code' => 4,
                'message' => 'Error',
                'data' => $e
            ], 502);
        }
    }
}
