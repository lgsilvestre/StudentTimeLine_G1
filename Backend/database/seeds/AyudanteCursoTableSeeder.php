<?php

use Illuminate\Database\Seeder;
use App\Ayudante_Con_Curso;
class AyudanteCursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ayudante_Con_Curso::create([
            'estudiante' => 2,
            'curso' => 1
        ]);
        
        Ayudante_Con_Curso::create([
            'estudiante' =>1,
            'curso' => 1
        ]);

        Ayudante_Con_Curso::create([
            'estudiante' => 2,
            'curso' => 2
        ]);
    }
}
