<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentOfSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_of_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id')->unsigned();
            $table->integer('monto');
            $table->integer('payment_id')->unsigned();
            $table->integer('iva');
            $table->integer('boleta');
            $table->integer('sede_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales')->ondelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments');
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
        Schema::dropIfExists('payment_of_sales');
    }
}
