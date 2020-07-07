<?php

use Illuminate\Database\Seeder;
use App\Curso;

class CursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $calculo1=Curso::create([
            'nombre' => 'Calculo I',
            'plan' => '2020',
            'descripcion' => 'Asignatura Calculo I', 
            'escuela' => 8 #Ramos comunes
        ]);

        $calculo2=Curso::create([
            'nombre' => 'Calculo II',
            'plan' => '2020',
            'descripcion' => 'Asignatura Calculo II', 
            'escuela' => 8 #Ramos comunes
        ]);

        $fisicaGeneral=Curso::create([
            'nombre' => 'Fisica General',
            'plan' => '2020',
            'descripcion' => 'Asignatura Física General', 
            'escuela' => 8 #Ramos comunes
        ]);
    }
}
