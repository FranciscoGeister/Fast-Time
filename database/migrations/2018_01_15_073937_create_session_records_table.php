<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cycle_id')->unsigned();
            $table->integer('session_tab_id')->unsigned();
            $table->integer('coach_id')->unsigned();
            $table->date('date');
            $table->float('rpe_wu')->nullable($value = true);
            $table->float('rpe_acc')->nullable($value = true);
            $table->float('rpe_stab')->nullable($value = true);
            $table->float('rpe_str')->nullable($value = true);
            $table->string('r_or_t_wu')->nullable($value = true);
            $table->string('r_or_t_est')->nullable($value = true);
            $table->string('r_or_t_str')->nullable($value = true);
            $table->string('r_or_t_acc')->nullable($value = true);
            $table->string('wu_o_1')->nullable($value = true);
            $table->string('wu_o_2')->nullable($value = true);
            $table->string('wu_o_3')->nullable($value = true);
            $table->string('wu_o_4')->nullable($value = true);
            $table->integer('wu_s_1')->nullable($value = true);
            $table->integer('wu_s_2')->nullable($value = true);
            $table->integer('wu_s_3')->nullable($value = true);
            $table->integer('wu_s_4')->nullable($value = true);
            $table->integer('wu_r_1')->nullable($value = true);
            $table->integer('wu_r_2')->nullable($value = true);
            $table->integer('wu_r_3')->nullable($value = true);
            $table->integer('wu_r_4')->nullable($value = true);
            $table->string('est_o_1')->nullable($value = true);
            $table->string('est_o_2')->nullable($value = true);
            $table->string('est_o_3')->nullable($value = true);
            $table->string('est_o_4')->nullable($value = true);
            $table->integer('est_s_1')->nullable($value = true);
            $table->integer('est_s_2')->nullable($value = true);
            $table->integer('est_s_3')->nullable($value = true);
            $table->integer('est_s_4')->nullable($value = true);
            $table->integer('est_r_1')->nullable($value = true);
            $table->integer('est_r_2')->nullable($value = true);
            $table->integer('est_r_3')->nullable($value = true);
            $table->integer('est_r_4')->nullable($value = true);
            $table->string('str_o_1')->nullable($value = true);
            $table->string('str_o_2')->nullable($value = true);
            $table->string('str_o_3')->nullable($value = true);
            $table->string('str_o_4')->nullable($value = true);
            $table->integer('str_s_1')->nullable($value = true);
            $table->integer('str_s_2')->nullable($value = true);
            $table->integer('str_s_3')->nullable($value = true);
            $table->integer('str_s_4')->nullable($value = true);
            $table->integer('str_r_1')->nullable($value = true);
            $table->integer('str_r_2')->nullable($value = true);
            $table->integer('str_r_3')->nullable($value = true);
            $table->integer('str_r_4')->nullable($value = true);
            $table->integer('str_w_1')->nullable($value = true);
            $table->integer('str_w_2')->nullable($value = true);
            $table->integer('str_w_3')->nullable($value = true);
            $table->integer('str_w_4')->nullable($value = true);
            $table->string('acc_o_1')->nullable($value = true);
            $table->string('acc_o_2')->nullable($value = true);
            $table->string('acc_o_3')->nullable($value = true);
            $table->string('acc_o_4')->nullable($value = true);
            $table->integer('acc_s_1')->nullable($value = true);
            $table->integer('acc_s_2')->nullable($value = true);
            $table->integer('acc_s_3')->nullable($value = true);
            $table->integer('acc_s_4')->nullable($value = true);
            $table->integer('acc_r_1')->nullable($value = true);
            $table->integer('acc_r_2')->nullable($value = true);
            $table->integer('acc_r_3')->nullable($value = true);
            $table->integer('acc_r_4')->nullable($value = true);
            $table->text('notes')->nullable($value = true);
            $table->timestamps();

            $table->foreign('cycle_id')->references('id')->on('cycles');
            $table->foreign('session_tab_id')->references('id')->on('session_tabs');
            $table->foreign('coach_id')->references('id')->on('profesionals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_records');
    }
}
