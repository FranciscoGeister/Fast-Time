<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('rut');
            $table->string('email')->unique();
            $table->string('celular');
            $table->integer('tipo');
            $table->date('nacimiento');
            $table->integer('estado');
            $table->string('sexo');
            $table->integer('id_sucursal')->unsigned();
            $table->string('password');
            $table->string('avatar')->nullable($value=true);
            $table->string('huella')->nullable($value=true);
            $table->tinyInteger('want_info');
            $table->timestamps();

            $table->foreign('id_sucursal')->references('id')->on('sedes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
