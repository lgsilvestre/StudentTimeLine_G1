<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InstanciaCurso extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'semestre','curso'
    ];
}
