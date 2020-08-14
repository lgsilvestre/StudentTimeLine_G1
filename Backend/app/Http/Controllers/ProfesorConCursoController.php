<?php

namespace App\Http\Controllers;

use App\Profesor_Con_Curso;
use Illuminate\Http\Request;
use Validator;


class ProfesorConCursoController extends Controller
{
    /**
     * Metodo que se encarga de bloquear las rutas del controlador Usuario
     */
    public function __construct(){
        $this->middleware(['permission:create profesor con curso'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:read profesor con curso'], ['only' => 'index']);
        $this->middleware(['permission:update profesor con curso'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete profesor con curso'], ['only' => 'delete']);
        $this->middleware(['permission:restore profesor con curso'], ['only' => 'disabled', 'restore']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $CursosyProfesores = Profesor_Con_Curso::all();
            return response()->json([
                'success' => true,
                'code' => 100,
                'message' => "La operacion se a realizado con exito",
                'data' => ['CursosyProfesores'=>$CursosyProfesores]
            ], 200);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 101,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return response()->json([
            'success' => false,
            'code' => 201,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El el protocolo se llama store']
        ], 426);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entradas = $request->only('profesor', 'curso');
        $validator = Validator::make($entradas, [
            'profesor' => ['required', 'numeric'],
            'curso' => [' required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("profesor" , $entradas)){
            $entradas['profesor'] = null;
        }
        if(!array_key_exists ("curso" , $entradas)){
            $entradas['curso'] = null;
        }
        try{
            $profesorCurso= new Profesor_Con_curso();
            $profesorCurso-> profesor=$entradas['profesor'];
            $profesorCurso-> curso=$entradas['curso'] ;
            $profesorCurso->save();
            return response()->json([
                'success' => true,
                'code' => 300,
                'message' => "Operacion realizada con exito",
                'data' => ['profesorCurso'=>$profesorCurso]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 

            if($ex->errorInfo[1]==1452){
                if(strlen(strstr($ex->errorInfo[2],'FOREIGN KEY (`profesor`)'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El profesor solicitado no existe. ",
                        'data' => ['error'=>$ex]
                    ], 409  );
 
                }else if(strlen(strstr($ex->errorInfo[2],'FOREIGN KEY (`curso`)'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El curso solicitado no existe. ",
                        'data' => ['error'=>$ex]
                    ], 409  );
 
                }
                
            }else if($ex->errorInfo[1]==1062){
                if(strlen(strstr($ex->errorInfo[2],'profesor__con__cursos_profesor_curso_unique'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El profesor ya esta asignado a este curso",
                        'data' => ['error'=>$ex]
                    ], 409  );
                }
            }


            

            return response()->json([
                'success' => false,
                'code' => 302,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        try{
            $cursos = Profesor_Con_Curso::Where('profesor', $id)->get();
            if($cursos==null){
                return response()->json([
                    'success' => true,
                    'code' => 401,
                    'message' => "El profesor no tiene ningun curso asociado",
                    'data' => ['cursos'=>$cursos]
                ], 200);
            }
            foreach ($cursos as $curso){
                $curso->profesor= $curso->getProfesor->nombre;
                $curso->idInstanciaCurso=$curso->getCurso->id;
                $curso->curso= $curso->getCurso->getCurso->nombre;
                $curso->semestre=$curso->getCurso->getSemestre->semestre;
                $curso->anio=$curso->getCurso->getSemestre->anio;
                $curso->seccion=$curso->getCurso->seccion;
            }
            return response()->json([
                'success' => true,
                'code' => 400,
                'message' => "La operacion se realizo con exito",
                'data' => ['cursos'=>$cursos]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 402,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesor_Con_Curso $profesor_Con_Curso)
    {
        return response()->json([
            'success' => false,
            'code' => 501,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El el protocolo se llama update']
        ], 426);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $entradas = $request->only('profesor', 'curso');
        $validator = Validator::make($entradas, [
            'profesor' => ['nullable', 'numeric'],
            'curso' => [' nullable', 'numeric'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 301,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        if(!array_key_exists ("profesor" , $entradas)){
            $entradas['profesor'] = null;
        }
        if(!array_key_exists ("curso" , $entradas)){
            $entradas['curso'] = null;
        }
        try{
            $profesorCurso = Profesor_Con_Curso::find($id);
            if ($profesorCurso == null) {
                return response()->json([
                    'success' => false,
                    'code' => 602,
                    'message' => 'La relacion profesor Curso con el id '.$id.' no existe',
                    'data' => null
                ], 409);
            }
            if($entradas['profesor']!=null){
                $profesorCurso-> profesor=$entradas['profesor'];
            }
            if($entradas['curso']!=null){
                $profesorCurso-> curso=$entradas['curso'] ;
            }
            $profesorCurso->save();
            return response()->json([
                'success' => true,
                'code' => 600,
                'message' => "Operacion realizada con exito",
                'data' => ['profesorCurso'=>$profesorCurso]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            if($ex->errorInfo[1]==1452){
                if(strlen(strstr($ex->errorInfo[2],'FOREIGN KEY (`profesor`)'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El profesor solicitado no existe. ",
                        'data' => ['error'=>$ex]
                    ], 409  );
 
                }else if(strlen(strstr($ex->errorInfo[2],'FOREIGN KEY (`curso`)'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El curso solicitado no existe. ",
                        'data' => ['error'=>$ex]
                    ], 409  );
 
                }
                
            }else if($ex->errorInfo[1]==1062){
                if(strlen(strstr($ex->errorInfo[2],'profesor__con__cursos_profesor_curso_unique'))>0){
                    return response()->json([
                        'success' => false,
                        'code' => 302,
                        'message' => "Error: El profesor ya esta asignado a este curso",
                        'data' => ['error'=>$ex]
                    ], 409  );
                }
            }




            return response()->json([
                'success' => false,
                'code' => 603,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409 );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $profesorCurso = Profesor_Con_Curso::find($id);
            if ($profesorCurso == null) {
                return response()->json([
                    'success' => false,
                    'code' => 701,
                    'message' => 'La relacion profesor Curso con el id '.$id.' no existe',
                    'data' => null
                ], 409 );
            }else{
                $profesorCurso->forceDelete();
                return response()->json([
                    'success' => true,
                    'code' => 700,
                    'message' => "Operacion realizada con exito",
                    'data' =>['profesorCurso'=> $profesorCurso]
                ], 200);
            }
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 702,
                'message' => "Error en la base de datos",
                'data' => ['error'=>$ex]
            ], 409 );
        }
    }
    public function disabled(){
        try{
            $profesoresCursos= Profesor_Con_Curso::onlyTrashed()->get();
            return response()->json([
                'success' => true,
                'code' => 800,
                'message' => "Operacion realizada con exito",
                'data' =>['profesoresCursos'=> $profesoresCursos]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 801,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Metodo que se encarga de recuperar una relacion profesor curso
     * Errores code inician 900
     */
    public function restore($id){
        try{
            $profesorCurso= Profesor_Con_Curso::onlyTrashed()->find($id)->restore();
            if($profesorCurso==false){
                return response()->json([
                    'success' => false,
                    'code' => 901,
                    'message' => "La relacion profesor Curso no se logro recuperar",
                    'data' => ['profesorCurso'=>$profesorCurso]
                ], 409);
            }
            return response()->json([
                'success' => true,
                'code' => 900,
                'message' => "La relacion profesor curso se recupero con exito",
                'data' => ['profesorCurso'=>$profesorCurso]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'code' => 902,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }



}
