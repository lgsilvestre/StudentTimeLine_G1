<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use SoftDeletes; 
    
    protected $fillable = [
        'nombre','plan','descripcion','escuela'
    ];

}
