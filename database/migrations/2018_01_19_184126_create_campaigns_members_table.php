<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('campaigns_members', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('campaign_id')->unsigned();
          $table->integer('member_id')->unsigned();
          $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
          $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
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
        Schema::dropIfExists('campaigns_members');
    }
}
