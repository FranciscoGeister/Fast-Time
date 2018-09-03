<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_has_plan_id')->unsigned();
            $table->text('meta_entrenamiento')->nullable($value = true);
            $table->text('hist_medic')->nullable($value = true);
            $table->timestamps();

            $table->foreign('member_has_plan_id')->references('id')->on('member_has_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation_sheets');
    }
}
