<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClavesForaneas1 extends Migration
{
    /* Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->bigInteger('escuela')->unsigned();
            $table->foreign('escuela')->references('id')->on('escuelas');
            $table->bigInteger('escuelaAux')->unsigned()->nullable();
            $table->foreign('escuelaAux')->references('id')->on('escuelas');
        });
    }

    /* Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}