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
            $table->foreign('ayudante')->references('id')->on('ayudante__con__cursos');
            $table->foreign('estudiante')->references('id')->on('estudiantes');
            $table->string('titulo');
            $table->string('descripcion');
            $table->foreign('profesor')->references('id')->on('users');
            $table->string('tipo');
            $table->foreign('curso')->references('id')->on('cursos');
            $table->string('categoria')->references('id')->on('categorias');;
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
