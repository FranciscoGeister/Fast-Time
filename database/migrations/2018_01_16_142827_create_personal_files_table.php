<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();
            $table->text('medical_history')->nullable($value = true);
            $table->text('training_goal')->nullable($value = true);
            $table->string('arm_size')->nullable($value = true);
            $table->string('glute_size')->nullable($value = true);
            $table->string('leg_size')->nullable($value = true);
            $table->string('vest_gender')->nullable($value = true);
            $table->string('vest_size')->nullable($value = true);
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_files');
    }
}
