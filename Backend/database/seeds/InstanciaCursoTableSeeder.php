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
            'semestre' => 1,
            'curso' => 1,
            'seccion'=> 'A'
        ]);

        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 2,
            'seccion'=> 'A'
        ]);

        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 3,
            'seccion'=> 'A'
        ]);
    }
}
