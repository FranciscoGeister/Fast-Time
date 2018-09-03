<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('profesional')->nullable($value = true); //profesional
            $table->datetime('start');
            $table->datetime('end');
            $table->time('begin')->nullable($value = true); //hour
            $table->time('finish')->nullable($value = true); //hour
            $table->integer('state')->nullable($value = true);
            $table->integer('id_prof')->nullable($value = true);
            $table->string('type')->nullable($value = true);
            $table->string('description')->nullable($value = true);
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
        Schema::dropIfExists('events');
    }
}
