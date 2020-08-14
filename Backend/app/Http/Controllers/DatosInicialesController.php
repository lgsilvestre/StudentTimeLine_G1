<?php

namespace App\Http\Controllers;
use App\Escuela;
use App\Estudiante;
use App\Observacion;
use App\User;
use Illuminate\Http\Request;

class DatosInicialesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datos(){
        try{
            $profesores= User::Where('rol', 'profesor')->count();
            $escuelas=Escuela::all()->count();
            $estudiantes=Estudiante::all()->count();
            $observaciones=Observacion::all()->count();
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['profesores'=>$profesores,
                            'escuelas'=>$escuelas,
                            'estudiantes'=>$estudiantes,
                            'observaciones'=>$observaciones]
            ], 200);
        //----- Mecanismos anticaidas y reporte de errores -----
        //este catch permite responder directamente que problemas en la peticion SQL
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 103,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }
}