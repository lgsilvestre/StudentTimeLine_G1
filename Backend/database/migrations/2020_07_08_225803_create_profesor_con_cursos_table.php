<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesorConCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesor__con__cursos', function (Blueprint $table) {
            #por simplicidad se dejo el atributo id para no tener complicaciones a la hora de filtrar una relacion
            #profesor-curso o a la hora de deshabilitar una relacion profesor-curso cuando este deje de impartir el curso
            $table->id();
            $table->bigInteger('profesor')->unsigned();
            $table->foreign('profesor')->references('id')->on('users');
            $table->bigInteger('curso')->unsigned();
            $table->foreign('curso')->references('id')->on('instancia_cursos');
            $table->softDeletes();
            $table->timestamps();
            #se deja como unique a los atributos profesor, semestre, anio y curso, ya que la finalidad de esta relación
            #es indicar desde cuando se esta haciendo cargo un profesor de un curso
            $table->unique(['profesor','curso']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesor__con__cursos');
    }
}

