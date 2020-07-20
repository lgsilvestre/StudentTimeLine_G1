<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Profesor_Con_Curso extends Model
{   
    use SoftDeletes; 
    protected $fillable = [
        'profesor','curso'
    ];

    protected $table='profesor__con__cursos';

    public function getCurso()
    {
        return $this->belongsTo(InstanciaCurso::class, 'curso');
    }  

    public function getProfesor()
    {
        return $this->belongsTo(User::class, 'profesor');
    } 

}
