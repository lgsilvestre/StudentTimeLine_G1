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
        Curso::create([
            'nombre' => 'Taller',
            'plan' => '2020',
            'descripcion' => 'Taller de desarrollo de software ', 
            'escuela' => 8 #Ramos comunes
        ]);

        Curso::create([
            'nombre' => 'Calculo II',
            'plan' => '2020',
            'descripcion' => 'Asignatura Calculo II', 
            'escuela' => 8 #Ramos comunes
        ]);

        Curso::create([
            'nombre' => 'Fisica General',
            'plan' => '2020',
            'descripcion' => 'Asignatura Física General', 
            'escuela' => 8 #Ramos comunes
        ]);

        Curso::create([
            'nombre' => 'Introducción la Matemática',
            'plan' => '16',
            'descripcion' => 'Ramo super entrete', 
            'escuela' => 8 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Comunicación Oral y Escrita I',
            'plan' => '16',
            'descripcion' => 'Ramo que corrige la escritura', 
            'escuela' => 8 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Idioma Extranjero I',
            'plan' => '16',
            'descripcion' => 'Estudio de idioma extranjero', 
            'escuela' => 8 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Álgebra',
            'plan' => '16',
            'descripcion' => 'Ramo matematico', 
            'escuela' => 8 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Cálculo I',
            'plan' => '16',
            'descripcion' => 'Ramo matematico', 
            'escuela' => 8 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Comunicación Oral y Escrita II',
            'plan' => '16',
            'descripcion' => 'Ramo entrete', 
            'escuela' => 8 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Idioma Extranjero II',
            'plan' => '16',
            'descripcion' => 'Estudio de la lengua extranjera', 
            'escuela' => 8 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Deporte I',
            'plan' => '16',
            'descripcion' => 'Ramo que da preferencia a mejorar la condición fisica', 
            'escuela' => 8 #Ramos computación
        ]);
        
        Curso::create([
            'nombre' => 'Introducción a la Programación',
            'plan' => '16',
            'descripcion' => 'Ramo introductorio a la carrera en el cual se compacta lo importante de los ramos a lo largo de la carrera', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Introducción a la ICC',
            'plan' => '16',
            'descripcion' => 'Ramo introductorio a la carrera en el cual se compacta lo importante de los ramos a lo largo de la carrera', 
            'escuela' => 1 #Ramos computación
        ]);
        Curso::create([
            'nombre' => 'Teoría de Sistemas',
            'plan' => '16',
            'descripcion' => 'Ramo super entrete', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Pensamiento Computacional',
            'plan' => '16',
            'descripcion' => 'curso orientado a resolver algoritmos ', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Interfaces Humano Computador',
            'plan' => '16',
            'descripcion' => 'el curso del oscuro ', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Programación Avanzada',
            'plan' => '16',
            'descripcion' => 'buela alto rodolfito y meza', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Lenguajes y Paradigmas de Programación',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Proyecto de Programación',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Algorítmos y Estructuras de Datos',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Modelos Discretos',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Requisitos de Software',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Metodologia de Desarrollo y Planificación de Proyectos de Software',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Diseño de Bases de Datos',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Diseño de Software',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Arquitectura de Computadores y Diseño de Circuitos Digitales',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Taller de Desarrollo de Software',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);

        Curso::create([
            'nombre' => 'Seguridad Informática',
            'plan' => '16',
            'descripcion' => 'aaa', 
            'escuela' => 1 #Ramos computación
        ]);
        
    }
}
