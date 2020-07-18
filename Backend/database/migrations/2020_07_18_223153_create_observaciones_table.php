<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ayudante')->unsigned()->nullable();
            $table->bigInteger('estudiante')->unsigned();
            $table->bigInteger('creador')->unsigned();
            $table->bigInteger('curso')->unsigned();
            $table->bigInteger('categoria')->unsigned();
            $table->bigInteger('tipo')->unsigned();
            $table->foreign('ayudante')->references('id')->on('ayudante__con__cursos');
            $table->foreign('estudiante')->references('id')->on('estudiantes');
            $table->string('titulo');
            $table->string('descripcion');
            $table->foreign('creador')->references('id')->on('users');
            $table->foreign('curso')->references('id')->on('cursos');
            $table->foreign('categoria')->references('id')->on('categorias');
            $table->foreign('tipo')->references('id')->on('tipo_observacions');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observaciones');
    }
}
