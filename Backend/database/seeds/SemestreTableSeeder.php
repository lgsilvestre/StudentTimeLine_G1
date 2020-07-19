<?php

use Illuminate\Database\Seeder;
use App\Semestre;
class SemestreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semestre::create([
            'semestre' => 2,
            'anio' => 2019
        ]);

        Semestre::create([
            'semestre' => 1,
            'anio' => 2020
        ]);

        Semestre::create([
            'semestre' => 2,
            'anio' => 1990
        ]);

        Semestre::create([
            'semestre' => 1,
            'anio' => 1990
        ]);

        Semestre::create([
            'semestre' => 1,
            'anio' => 2001
        ]);
    }
}