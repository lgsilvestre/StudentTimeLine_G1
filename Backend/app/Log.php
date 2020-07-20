<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    protected $fillable = [
        'titulo', 'descripcion','usuario'
    ];

    protected $casts = [
        'descripcion' => 'array'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'usuario');
    }  
}
