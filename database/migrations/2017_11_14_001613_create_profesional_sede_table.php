<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesionalSedeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('profesional_sede', function(Blueprint $table){
        $table->increments('id');
        $table->integer('profesional_id')->unsigned();
        $table->integer('sede_id')->unsigned();
        $table->foreign('profesional_id')->references('id')->on('profesionals')->onDelete('cascade');
        $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade');
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
        Schema::dropIfExists('profesional_sede');
    }
}
