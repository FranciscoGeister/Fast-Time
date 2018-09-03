<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSedeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('event_sede', function(Blueprint $table){
      $table->increments('id');
      $table->integer('event_id')->unsigned();
      $table->integer('sede_id')->unsigned();
      $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
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
        Schema::dropIfExists('event_sede');
    }
}
