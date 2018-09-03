<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalDebtHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_debt_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->integer('profesional_id');

            $table->foreign('profesional_id')->references('id')->on('profesionals');
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
        Schema::dropIfExists('professional_debt_histories');
    }
}
