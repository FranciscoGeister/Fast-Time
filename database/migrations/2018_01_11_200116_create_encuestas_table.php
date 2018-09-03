<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_socio')->unique()->unsigned();
            $table->boolean('amigo');
            $table->boolean('nos_revista');
            $table->boolean('tell_revista');
            $table->boolean('datos_revista');
            $table->boolean('el_sur_revista');
            $table->boolean('otra_revista');
            $table->boolean('tv');
            $table->boolean('pantalla');
            $table->boolean('flyer');
            $table->boolean('facebook');
            $table->boolean('otras_redes');
            $table->text('otro')->nullable($value=true);
            $table->foreign('id_socio')->references('id')->on('members');
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
        Schema::dropIfExists('encuestas');
    }
}
