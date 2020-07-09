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
            'curso' => 1
        ]);

        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 2
        ]);

        InstanciaCurso::create([
            'semestre' => 1,
            'curso' => 3
        ]);
    }
}
