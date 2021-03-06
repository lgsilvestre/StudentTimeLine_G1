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
            $table->id();
            $table->integer('matricula')->unique();
            $table->string('rut')->unique();
            $table->string('nombre_completo'); //nullable(false) no admite valores null
            $table->string('correo')->unique();
            $table->integer('anho_ingreso');
            $table->string('situacion_academica');
            $table->integer('porcentaje_avance');
            $table->integer('creditos_aprobados');
            $table->bigInteger('escuela')->unsigned();
            $table->foreign('escuela')->references('id')->on('escuelas');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE estudiantes ADD foto MEDIUMBLOB");
        DB::statement("ALTER TABLE estudiantes CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
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
