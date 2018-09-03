<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasHabitosMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas_habitos_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pregunta_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->string('respuesta');
            $table->foreign('pregunta_id')->references('id')->on('preguntas_habitos');
            $table->foreign('member_id')->references('id')->on('members');
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
        Schema::dropIfExists('preguntas_habitos_members');
    }
}
