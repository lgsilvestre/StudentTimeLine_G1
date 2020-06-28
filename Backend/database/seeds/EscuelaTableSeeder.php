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
            'nombre' => 'Escuela de Computación',
            'cod_escuela' => 407

        ]);

        $ici=Escuela::create([
            'nombre' => 'Escuela de Industrial',
            'cod_escuela' => 408
        ]);

        $ice=Escuela::create([
            'nombre' => 'Escuela de Eléctrica',
            'cod_escuela' => 409
        ]);

        $icm=Escuela::create([
            'nombre' => 'Escuela de Mecánica',
            'cod_escuela' => 410
        ]);

        $icoc=Escuela::create([
            'nombre' => 'Escuela de Obras Civiles',
            'cod_escuela' => 411
        ]);

        $icm=Escuela::create([
            'nombre' => 'Escuela de Minas',
            'cod_escuela' => 412
        ]);

        $icme=Escuela::create([
            'nombre' => 'Escuela de Mecatrónica',
            'cod_escuela' => 413
        ]);

        $rc=Escuela::create([
            'nombre' => 'Ramos Comunes',
            'cod_escuela' => 000
        ]);

        $fi=Escuela::create([
            'nombre' => 'Facultad de ingenieria',
            'cod_escuela' => 001
        ]);

    }
}
