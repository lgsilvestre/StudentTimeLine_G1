<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Profesor_Con_Curso extends Model
{   
    use SoftDeletes; 
    protected $fillable = [
        'profesor','curso','anio','semestre'
    ];
}
