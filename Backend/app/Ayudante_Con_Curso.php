<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ayudante_Con_Curso extends Model
{
    use SoftDeletes; 
    
    protected $fillable=[
        'curso','estudiante'
    ];
}