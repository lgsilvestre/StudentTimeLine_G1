<?php

use Illuminate\Database\Seeder;
use App\Carrera;

class CarreraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Computación, Industrial, Eléctrica, Mecánica, Obras Civiles, Minas, Mecatrónica
        $icc=Carrera::create([
            'nombre' => 'Ingeniería Civil en Computación'
        ]);

        $ici=Carrera::create([
            'nombre' => 'Ingeniería Civil Industrial'
        ]);

        $ice=Carrera::create([
            'nombre' => 'Ingeniería Civil Eléctrica'
        ]);

        $icm=Carrera::create([
            'nombre' => 'Ingeniería Civil Mecánica'
        ]);

        $icoc=Carrera::create([
            'nombre' => 'Ingeniería Civil en Obras Civiles'
        ]);

        $icm=Carrera::create([
            'nombre' => 'Ingeniería Civil de Minas'
        ]);

        $icme=Carrera::create([
            'nombre' => 'Ingeniería Civil Mecatrónica'
        ]);
    }
}
