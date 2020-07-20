<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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


    public function filtrarEscuela($request)
    {
        //Para filtrar después puedo utilizar lo mismo...
        //return collect(DB::select('select * from ' . $this->getTable()));
        return collect(DB::select('select * from ' . $this->getTable() .' where escuela = '.$request)); 
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

    public function getEscuela(){
        return $this->belongsTo('App\Escuela','escuela');
    }
}
