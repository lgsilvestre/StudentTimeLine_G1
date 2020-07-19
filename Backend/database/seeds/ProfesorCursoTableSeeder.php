<?php

use Illuminate\Database\Seeder;
use App\Profesor_Con_Curso;

class ProfesorCursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profesor_Con_Curso::create([
            'profesor' => 6,
            'curso' => 1

        ]);
        Profesor_Con_Curso::create([
            'profesor' => 5,
            'curso' => 2
        ]);

        Profesor_Con_Curso::create([
            'profesor' => 29,
            'curso' => 4
        ]);
        Profesor_Con_Curso::create([
            'profesor' => 29,
            'curso' => 5
        ]);
        Profesor_Con_Curso::create([
            'profesor' => 18,
            'curso' => 6
        ]);
        Profesor_Con_Curso::create([
            'profesor' => 18,
            'curso' => 7
        ]);
        Profesor_Con_Curso::create([
            'profesor' => 36,
            'curso' => 8
        ]);
        Profesor_Con_Curso::create([
            'profesor' => 36,
            'curso' => 9
        ]);
    }
}
