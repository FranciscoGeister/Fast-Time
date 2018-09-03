<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->foreign('notification_id')->references('id')->on('notifications');
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
        Schema::dropIfExists('notification_members');
    }
}
