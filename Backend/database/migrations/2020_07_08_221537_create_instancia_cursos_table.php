<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstanciaCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instancia_cursos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('semestre')->unsigned();
            $table->bigInteger('curso')->unsigned();
            $table->softDeletes();
            $table->string('seccion');
            $table->foreign('semestre')->references('id')->on('semestres');
            $table->foreign('curso')->references('id')->on('cursos');
            $table->timestamps();
            $table->unique(['semestre','curso']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instancia_cursos');
    }
}
