<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Semestre extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'semeste','anio'
    ];

}
