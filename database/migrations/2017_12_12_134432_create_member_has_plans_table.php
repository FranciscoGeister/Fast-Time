<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberHasPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_has_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->date('inicio')->nullable($value = true);
            $table->date('vencimiento')->nullable($value = true);
            $table->text('comen_venc')->nullable($value = true);
            $table->integer('plan_or_prog');
            $table->string('contrato')->nullable($value = true);
            $table->tinyInteger('active');
            $table->tinyInteger('new');
            $table->tinyInteger('estado');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_has_plans');
    }
}
