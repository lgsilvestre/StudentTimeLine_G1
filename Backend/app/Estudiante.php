<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use DB;
use App\Estudiante;

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
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $escuela = $request->escuela;
        $idEstudiante = $request->id;

        dump($tipo);
        dump($fechaInicio);
        dump($fechaFin);
        dump($escuela);
        dump($idEstudiante);

        if($tipo == 1){
            dump('es tipo 1');
            return collect(DB::table('estudiantes')
                        ->select('matricula','rut','nombre_completo','correo','anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuela', DB::Raw('COUNT(observaciones.id) AS cant_observaciones'))
                        ->join('observaciones', 'estudiantes.id','=', 'observaciones.estudiante')
                        ->groupBy('matricula','rut','nombre_completo','correo','anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuela')
                        ->get());
        }
        elseif($tipo == 2){
            dump('es tipo 2');
            return collect(DB::table('estudiantes')
                    ->join('observaciones', 'estudiantes.id','=', 'observaciones.estudiante')
                    ->whereBetween('observaciones.created_at',[$fechaInicio,$fechaFin])
                    ->get());
        }
        elseif($tipo == 3){ #ESTA ES PARA RETORNAR PDF NO EXCEL
            dump('es tipo 3');
            return collect(DB::table('estudiantes')
                    ->join('observaciones', 'estudiantes.id','=', 'observaciones.estudiante')
                    ->where('estudiantes.id','=',$idEstudiante)
                    ->get());
        }

        //return collect(DB::select('select matricula, rut, nombre_completo, correo, anho_ingreso, situacion_academica, porcentaje_avance, creditos_aprobados, escuela from ' . $this->getTable() .' where escuela = '.$escuela)); 
        //$estudiantes = Estudiante::Where('escuela',$escuela)->get();
        //return collect(DB::select('select matricula, rut, nombre_completo, correo, anho_ingreso, situacion_academica, porcentaje_avance, creditos_aprobados, escuela 
        //from escuelas, observaciones ' where escuela = '.$escuela)); 
    }

    public function getTableColumns()
    {
        $query = "SELECT column_name 
        FROM information_schema.columns 
        WHERE table_name = 'estudiantes'
        AND table_schema = 'backend'";

        $result = DB::select($query);
        //Tengo que transformar las filas a columnas
        $result = $this->transposeData($result);
        //dd($result);
        return $result;
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
 
   
}
