<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoldPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sold_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->integer('plan_or_prog');
            //para cuando se anule una venta de plan
            $table->integer('member_has_plan_id');
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales');
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
        Schema::dropIfExists('sold_plans');
    }
}
