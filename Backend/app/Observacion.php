<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Observacion extends Model
{
    use SoftDeletes; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ayudante', 'estudiante', 'titulo', 'descripcion', 'profesor', 'tipo','curso','categoria'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'observaciones';
    }
