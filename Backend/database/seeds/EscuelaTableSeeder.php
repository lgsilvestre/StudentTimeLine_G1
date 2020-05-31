<?php

use Illuminate\Database\Seeder;
use App\Escuela;
class EscuelaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Computación, Industrial, Eléctrica, Mecánica, Obras Civiles, Minas, Mecatrónica
        $icc=Escuela::create([
            'nombre' => 'Ingeniería Civil en Computación',
            'cod_carrera' => 407

        ]);

        $ici=Escuela::create([
            'nombre' => 'Ingeniería Civil Industrial',
            'cod_carrera' => 408
        ]);

        $ice=Escuela::create([
            'nombre' => 'Ingeniería Civil Eléctrica',
            'cod_carrera' => 409
        ]);

        $icm=Escuela::create([
            'nombre' => 'Ingeniería Civil Mecánica',
            'cod_carrera' => 410
        ]);

        $icoc=Escuela::create([
            'nombre' => 'Ingeniería Civil en Obras Civiles',
            'cod_carrera' => 411
        ]);

        $icm=Escuela::create([
            'nombre' => 'Ingeniería Civil de Minas',
            'cod_carrera' => 412
        ]);

        $icme=Escuela::create([
            'nombre' => 'Ingeniería Civil Mecatrónica',
            'cod_carrera' => 413
        ]);
    }
}
