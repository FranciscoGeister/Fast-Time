<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pregunta_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->text('respuesta');
            $table->foreign('pregunta_id')->references('id')->on('preguntas_medicas');
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
        Schema::dropIfExists('preguntas_members');
    }
}
