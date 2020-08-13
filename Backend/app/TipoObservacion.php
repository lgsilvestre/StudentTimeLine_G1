<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoObservacion extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'descripcion'
    ];
}
