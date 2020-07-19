<?php

namespace App;

use App\Http\Controllers\UsuarioController;
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
        'ayudante', 'estudiante', 'titulo', 'descripcion', 'creador', 'tipo','curso','categoria'
    ];

    public function getEstudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante');
    } 

    public function getCreador()
    {
        return $this->belongsTo(User::class, 'creador');
    } 

    public function getTipo()
    {
        return $this->belongsTo(TipoObservacion::class, 'tipo');
    } 

    public function getCurso()
    {
        return $this->belongsTo(Curso::class, 'curso');
    }  

    public function getCategoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria');
    }   

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'observaciones';
    }
