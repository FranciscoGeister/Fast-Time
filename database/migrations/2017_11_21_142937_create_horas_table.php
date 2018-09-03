<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_prof')->unsigned();
          $table->foreign('id_prof')
                ->references('id')->on('profesionals')
                ->onDelete('cascade');
          $table->integer('id_socio')->unsigned();
          $table->foreign('id_socio')
                ->references('id')->on('members')
                ->onDelete('cascade');
          $table->string('title');
          $table->string('socio');
          $table->string('type');
          $table->datetime('start');
          $table->datetime('end');
          $table->integer('event_id')->nullable($value = true); //id
          $table->time('begin')->nullable($value = true); //hour
          $table->time('finish')->nullable($value = true); //finish
          $table->text('description')->nullable($value = true);
          $table->integer('estado')->unsigned();
          $table->foreign('estado')->references('id')->on('statuses');
          $table->string('color', 7);
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
        Schema::dropIfExists('horas');
    }
}
