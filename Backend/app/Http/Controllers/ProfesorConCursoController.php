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
        #Podríamos retornar los nombres en lugar del id del profesor y del curso.
        $CursosyProfesores = Profesor_Con_Curso::all();
        return response()->json([
            'success' => true,
            'code' => 100,
            'message' => "La operacion se a realizado con exito",
            'data' => ['CursosyProfesores'=>$CursosyProfesores]
        ], 200);
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
        //
        $profesorCurso= new Profesor_Con_curso();
        $profesorCurso-> profesor=$request->profesor;
        $profesorCurso-> curso=$request->curso;
        $profesorCurso->save();
        return response()->json([
            'success' => true,
            'code' => 300,
            'message' => "Operacion realizada con exito",
            'data' => ['profesorCurso'=>$profesorCurso]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor_Con_Curso $profesor_Con_Curso)
    {
        return response()->json([
            'success' => false,
            'code' => 401,
            'message' => 'Este recurso está bloqueado',
            'data' => ['error'=>'El el protocolo se llama index']
        ], 426);
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
            'code' => 401,
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
        $CursoProfesor = Profesor_Con_Curso::find($id);
        $CursoProfesor->profesor = $request->profesor ;
        $CursoProfesor->curso = $request->curso;
        $CursoProfesor->save();
        return response()->json([
            'success' => true,
            'code' => 600,
            'message' => "Operacion realizada con exito",
            'data' => ['CursoProfesor'=>$CursoProfesor]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profesor_Con_Curso  $profesor_Con_Curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $profesorCurso = Profesor_Con_Curso::find($id);
        $profesorCurso->delete();
        return response()->json([
            'success' => true,
            'code' => 700,
            'message' => "Operacion realizada con exito",
            'data' =>['profesorCurso'=> $profesorCurso]
        ], 200);
    }
    public function disabled(){

        $profesoresCursos= Profesor_Con_Curso::onlyTrashed()->get();
        return response()->json([
            'success' => true,
            'code' => 800,
            'message' => "Operacion realizada con exito",
            'data' =>['profesoresCursos'=> $profesoresCursos]
        ], 200);
    }

    public function restore($id){
        
        $profesorCurso= Profesor_Con_Curso::onlyTrashed()->find($id)->restore();
        return response()->json([
            'success' => true,
            'code' => 900,
            'message' => "La escuela recupero con exito",
            'data' => ['profesorCurso'=>$profesorCurso]
        ], 200);
    }



}
