<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_homeworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();
            $table->integer('exercise_id')->unsigned();
            $table->integer('series');
            $table->integer('repetitions');
            $table->integer('rest');
            $table->text('comment')->nullable($value = true);
            $table->boolean('completed')->default(false);
            $table->integer('profesional_id');
            $table->integer('evaluation_session_id');
            $table->integer('evaluation_sheet_id');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('exercise_id')->references('id')->on('exercises');
            $table->foreign('profesional_id')->references('id')->on('profesionals');
            $table->foreign('evaluation_session_id')->references('id')->on('evaluation_sessions');
            $table->foreign('evaluation_sheet_id')->references('id')->on('evaluation_sheets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation_homeworks');
    }
}
