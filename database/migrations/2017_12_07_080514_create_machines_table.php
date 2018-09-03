<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->integer('sede_id');
            $table->string('marca');
            $table->string('color');
            $table->date('fecha_compra');
            $table->string('vendedor');
            $table->integer('estado');
            $table->text('descripcion')->nullable($value = true);
            $table->timestamps();

            $table->foreign('sede_id')->references('id')->on('sedes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machines');
    }
}