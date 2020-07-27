<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    protected $fillable = [
        'titulo', 'accion', 'tipo', 'descripcion', 'data','usuario'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'usuario')->withTrashed();
    }  
}
