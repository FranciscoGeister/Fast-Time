<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profesional_id');
            $table->date('date');
            $table->integer('sede_id');
            $table->time('start');
            $table->time('end')->nullable($value = true);
            $table->time('hours_worked')->nullable($value = true);
            $table->timestamps();

            $table->foreign('profesional_id')->references('id')->on('profesionals');
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
        Schema::dropIfExists('working_days');
    }
}
