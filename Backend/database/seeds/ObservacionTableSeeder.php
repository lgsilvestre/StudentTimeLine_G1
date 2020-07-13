<?php

use Illuminate\Database\Seeder;
use App\Observacion;
class ObservacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Observacion::create([
            'ayudante' => 1,
            'estudiante' => '1',
            'titulo' => 'Comentario 1', 
            'descripcion' => 'Muy buen ayudante.',
            'profesor' => 7,
            'tipo' =>'POSITIVA',
            'curso' => 1, 
            'categoria' => 1,
        ]);

        Observacion::create([
            'ayudante' => 1,
            'estudiante' => '1',
            'titulo' => 'Comentario 2', 
            'descripcion' => 'Muy buen ayudante.',
            'profesor' => 7,
            'tipo' =>'POSITIVA',
            'curso' => 1, 
            'categoria' => 1,
        ]);

        Observacion::create([
            'ayudante' => 1,
            'estudiante' => '1',
            'titulo' => 'Comentario 3', 
            'descripcion' => 'Muy buen ayudante.',
            'profesor' => 7,
            'tipo' =>'POSITIVA',
            'curso' => 1, 
            'categoria' => 1,
        ]);
    }
}
