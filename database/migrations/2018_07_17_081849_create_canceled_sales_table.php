<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanceledSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canceled_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();
            $table->integer('sede_id')->nullable($value = true)->unsigned();
            $table->integer('monto');
            $table->integer('boleta');
            $table->integer('iva');
            $table->date('date');
            $table->integer('user_id');
            //user that canceled the sale
            $table->integer('user2_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user2_id')->references('id')->on('users');
            $table->foreign('member_id')->references('id')->on('members');
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
        Schema::dropIfExists('canceled_sales');
    }
}
