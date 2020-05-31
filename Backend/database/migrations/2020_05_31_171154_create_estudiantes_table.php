<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->integer('matricula')->primary();
            $table->string('rut')->unique();
            $table->string('nombre_completo')->nullable(false); //nullable(false) no admite valores null
            $table->string('correo')->unique();
            $table->string('anho_ingreso')->nullable(false);
            $table->string('situacion_academica')->nullable(false);
            $table->integer('porcentaje_avance')->nullable(false);
            $table->integer('creditos_aprobados')->nullable(false);
            $table->softDeletes();
            $table->timestamps();
            
            $table->bigInteger('escuela')->unsigned()->nullable(false);
            $table->foreign('escuela')->references('id')->on('escuelas');
           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
