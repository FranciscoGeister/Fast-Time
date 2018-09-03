<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberHasSesionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_has_sesions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();
            $table->integer('tipo_sesion');
            $table->integer('cantidad');
            $table->integer('member_has_plan_id')->unsigned();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
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
        Schema::dropIfExists('member_has_sesions');
    }
}
