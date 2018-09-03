<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('boleta');
            $table->integer('cant_agregar');
            $table->text('comentario')->nullable($value = true);
            $table->integer('id_user');
            $table->integer('id_product');
            $table->integer('id_sucursal');
            $table->string('tipo');
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
        Schema::dropIfExists('product_entries');
    }
}
