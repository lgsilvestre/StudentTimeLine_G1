<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escuela extends Model
{
    use SoftDeletes; 
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','cod_carrera'
    ];
    protected $table='escuelas';
    
    public function usuarios (){
        return $this-> hasMany('App\User','escuela');

    }

}
