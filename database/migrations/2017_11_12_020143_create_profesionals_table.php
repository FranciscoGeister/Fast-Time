<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Profesional;
class CreateProfesionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesionals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('mother_last_name', 100)->nullable($value = true);
            $table->date('nacimiento');
            $table->string('email');
            $table->integer('tipo')->unsigned();
            $table->string('celular')->nullable($value = true);
            $table->string('rut')->unique();
            $table->string('color', 7);
            $table->string('avatar')->nullable($value = true);
            $table->string('huella')->nullable($value = true);
            $table->integer('link');
            $table->integer('contracted_hours')->nullable($value = true);
            $table->integer('estado');
            $table->foreign('tipo')->references('id')->on('cargos');
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
        Schema::dropIfExists('profesionals');
    }
}
