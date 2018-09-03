<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_origen');
            $table->integer('id_destino');
            $table->integer('cantidad');
            $table->integer('id_product_origen');
            $table->integer('id_product_destino');
            $table->integer('id_user');
            $table->string('tipo');
            $table->text('comentario')->nullable($value = true);
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
        Schema::dropIfExists('product_transfers');
    }
}
