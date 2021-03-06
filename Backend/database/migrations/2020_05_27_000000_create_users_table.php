<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',64);#('name', MAX) VARCHAR
            $table->string('rol');
            //$table->string('foto')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('codigoRecuperacion')->nullable();
            $table->dateTime('fechaRecuperacion')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            //referenciando a la escuela
            
        });
        DB::statement("ALTER TABLE users ADD foto MEDIUMBLOB");
        DB::statement("ALTER TABLE users CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
