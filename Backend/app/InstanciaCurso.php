<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InstanciaCurso extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'semestre','curso','seccion'
    ];

    public function getCurso()
    {
        return $this->belongsTo(Curso::class, 'curso')->withTrashed();
    }  

    public function getSemestre()
    {
        return $this->belongsTo(Semestre::class, 'semestre')->withTrashed();
    }  
}
