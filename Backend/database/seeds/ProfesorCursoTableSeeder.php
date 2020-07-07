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
        $relacion1=Profesor_Con_Curso::create([
            'profesor' => 6,
            'curso' => 1,
            'anio' => '2020', 
            'semestre' => 1
        ]);

        $relacion2=Profesor_Con_Curso::create([
            'profesor' => 6,
            'curso' => 2,
            'anio' => '2020', 
            'semestre' => 1
        ]);

        $relacion3=Profesor_Con_Curso::create([
            'profesor' => 7,
            'curso' => 3,
            'anio' => '2020', 
            'semestre' => 1
        ]);
    }
}
