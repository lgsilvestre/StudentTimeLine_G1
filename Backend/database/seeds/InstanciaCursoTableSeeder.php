<?php

use Illuminate\Database\Seeder;
use App\InstanciaCurso;
class InstanciaCursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InstanciaCurso::create([
            'semestre' => 2,
            'curso' => 1,
            'seccion'=> 'A'
        ]);

        InstanciaCurso::create([
            'semestre' => 2,
            'curso' => 2,
            'seccion'=> 'A'
        ]);

        InstanciaCurso::create([
            'semestre' => 2,
            'curso' => 3,
            'seccion'=> 'A'
        ]);

        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 12,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 12,
            'seccion'=> 'B'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 14,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 14,
            'seccion'=> 'B'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 13,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 13,
            'seccion'=> 'B'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 16,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 15,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 17,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 18,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 19,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 21,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 22,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 23,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 24,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 25,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 26,
            'seccion'=> 'A'
        ]);
        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 21,
            'seccion'=> 'A'
        ]);


    }
}
