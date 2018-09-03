<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePathologiesMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pathologies_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pathology_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->foreign('pathology_id')->references('id')->on('pathologies');
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
        Schema::dropIfExists('pathologies_members');
    }
}
