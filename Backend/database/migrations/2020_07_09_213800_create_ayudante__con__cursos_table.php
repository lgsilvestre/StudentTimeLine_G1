<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAyudanteConCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayudante__con__cursos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('estudiante')->unsigned();
            $table->bigInteger('curso')->unsigned();
            $table->foreign('curso')->references('id')->on('instancia_cursos');
            $table->foreign('estudiante')->references('id')->on('estudiantes');
            $table->softDeletes();
            $table->unique(['estudiante','curso']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayudante__con__cursos');
    }
}
