<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes; 
    
    protected $fillable = [
        'nombre','plan','descripcion','escuela'
    ];

    public function getEscuela(){
        return $this->belongsTo('App\Escuela','escuela')->withTrashed();
    }

}
