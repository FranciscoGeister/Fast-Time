<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCleaningProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cleaning_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('marca');
            $table->integer('stock');
            $table->integer('stock_critico');
            $table->integer('id_sucursal')->unsigned();
            $table->integer('estado');
            $table->text('descripcion')->nullable($value = true);
            $table->timestamps();

            //$table->primary(['id','id_sucursal']);
            $table->foreign('id_sucursal')->references('id')->on('sedes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cleaning_products');
    }
}
