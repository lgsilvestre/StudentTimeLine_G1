<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use DB;

class Estudiante extends Model
{
    use SoftDeletes; 

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'matricula', 'rut', 'nombre_completo', 'correo', 'anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuela', 'foto'
    ];


    public function filtrarExportar(Request $request)
    {
        $tipo = $request->tipo;
        

        if($tipo == 1)
        {
            $escuela = $request->escuela;
            $data = collect(DB::table('estudiantes')
                ->select('matricula','rut','nombre_completo','correo','anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuelas.nombre')
                ->join('escuelas', 'escuelas.id','=', 'estudiantes.escuela')
                ->where('estudiantes.escuela','=',$escuela)
                ->get());
            return $data;
        }
        elseif($tipo == 2)
        {
            $fechaInicio = $request->fechaInicio;
            $fechaFin = $request->fechaFin;
            $data = collect(DB::table('estudiantes')
                    ->select('matricula','rut','nombre_completo','correo','anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuelas.nombre', DB::Raw('COUNT(observaciones.id) AS cant_observaciones'))
                    ->join('escuelas', 'escuelas.id','=', 'estudiantes.escuela')
                    ->join('observaciones', 'estudiantes.id','=', 'observaciones.estudiante')
                    ->groupBy('matricula','rut','nombre_completo','correo','anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuelas.nombre')
                    ->whereBetween('observaciones.created_at',[$fechaInicio,$fechaFin])
                    ->get());
            return $data;
        }
        elseif($tipo == 3)
        {
            $idEstudiante = $request->id;
            /*
            $data = collect(DB::table('estudiantes')
                    ->select('matricula','rut','nombre_completo','correo','anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuelas.nombre', 'users.nombre', 'cursos.nombre', 'categorias.nombre','observaciones.titulo', 'observaciones.descripcion', 'observaciones.tipo')
                    ->join('escuelas', 'escuelas.id','=', 'estudiantes.escuela')
                    ->join('observaciones', 'estudiantes.id','=', 'observaciones.estudiante')
                    ->join('users', 'observaciones.profesor','=', 'users.id')
                    ->join('cursos', 'observaciones.curso','=', 'cursos.id')
                    ->join('categorias', 'observaciones.categoria','=', 'categorias.id')
                    ->where('estudiantes.id','=',$idEstudiante)
                    ->get());*/
            $data = collect(DB::table('observaciones')
                    ->select('users.nombre AS profesor', 'cursos.nombre AS curso', 'categorias.nombre AS categoria','observaciones.titulo', 'observaciones.descripcion', 'observaciones.tipo')
                    ->join('users', 'users.id','=', 'observaciones.profesor')
                    ->join('cursos', 'observaciones.curso','=', 'cursos.id')
                    ->join('categorias', 'observaciones.categoria','=', 'categorias.id')
                    ->where('observaciones.estudiante','=',$idEstudiante)
                    ->get());
            return $data;
        }
    }

    public function obtenerInfoEstudiante(Request $request)
    {
        $idEstudiante = $request->id;

        $estudiante = collect(DB::table('estudiantes')
                ->select('matricula','rut','nombre_completo','correo','anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuelas.nombre AS escuela')
                ->join('escuelas', 'escuelas.id','=', 'estudiantes.escuela')
                ->where('estudiantes.id','=',$idEstudiante)
                ->get());
        return $estudiante;
    }

    public function getTableColumns(Request $request)
    {
        $tipo = $request->tipo;
        /*$tipo = $request->tipo;
        $query = "SELECT column_name 
        FROM information_schema.columns 
        WHERE table_name = 'estudiantes'
        AND table_schema = 'backend'";*/
        
        if($request->tipo == 1)
        {
            $columnas = array("nombre_columna" => ['matricula', 'rut', 'nombre_completo', 'correo', 'anho_ingreso', 'situacion_academica','porcentaje_avance', 'creditos_aprobados', 'escuela']);
            return $columnas;
        }
        elseif($request->tipo == 2)
        {
            $columnas = array("nombre_columna" => ['matricula', 'rut', 'nombre_completo', 'correo', 'anho_ingreso', 'situacion_academica','porcentaje_avance', 'creditos_aprobados', 'escuela', 'cant_observaciones']);
            return $columnas;
        }
        elseif($request->tipo == 3)
        {
            $columnas = array("nombre_columna" => ['matricula', 'rut', 'nombre_completo', 'correo', 'anho_ingreso', 'situacion_academica','porcentaje_avance', 'creditos_aprobados', 'escuela']);
            return $columnas;
        }
        /*
        $result = DB::select($query);
        //Tengo que transformar las filas a columnas
        $result = $this->transposeData($result);*/
        
        return null;
    }

    //Filas a colummnas
    public function transposeData($data)
    {
        $result = array();

        foreach($data as $row => $columns)
        {
            foreach ($columns as $row2 => $column2)
            {

                $result[$row2][$row] = $column2;
            }
        }
        return $result;
    }

    public function getEscuela(){
        return $this->belongsTo('App\Escuela','escuela')->withTrashed();
    }
}
