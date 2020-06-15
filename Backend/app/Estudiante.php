<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estudiante extends Model
{
    use SoftDeletes; 

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'matricula', 'rut', 'nombre_completo', 'correo', 'anho_ingreso','situacion_academica','porcentaje_avance','creditos_aprobados','escuela'
    ];



 
   
}
