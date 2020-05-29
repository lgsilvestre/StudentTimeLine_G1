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
            'nombre' => 'Ingeniería Civil en Computación'
        ]);

        $ici=Escuela::create([
            'nombre' => 'Ingeniería Civil Industrial'
        ]);

        $ice=Escuela::create([
            'nombre' => 'Ingeniería Civil Eléctrica'
        ]);

        $icm=Escuela::create([
            'nombre' => 'Ingeniería Civil Mecánica'
        ]);

        $icoc=Escuela::create([
            'nombre' => 'Ingeniería Civil en Obras Civiles'
        ]);

        $icm=Escuela::create([
            'nombre' => 'Ingeniería Civil de Minas'
        ]);

        $icme=Escuela::create([
            'nombre' => 'Ingeniería Civil Mecatrónica'
        ]);
    }
}
