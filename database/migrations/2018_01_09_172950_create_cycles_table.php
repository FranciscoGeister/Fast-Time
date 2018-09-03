<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cycles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_tab_id')->unsigned();
            $table->integer('coach_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->date('date');
            $table->tinyInteger('metabolic')->nullable($value = true);
            $table->tinyInteger('tonification')->nullable($value = true);
            $table->tinyInteger('recuperation')->nullable($value = true);
            $table->string('cycle_obj')->nullable($value = true);   
            $table->tinyInteger('stabilization')->nullable($value = true);
            $table->tinyInteger('acc_metab')->nullable($value = true);
            $table->tinyInteger('strength')->nullable($value = true);
            $table->integer('warm_up_time')->nullable($value = true);
            $table->integer('stabilization_time')->nullable($value = true);
            $table->integer('strength_time')->nullable($value = true);
            $table->integer('acc_metab_time')->nullable($value = true);
            $table->float('rpe_wu_min')->nullable($value = true);
            $table->float('rpe_wu_max')->nullable($value = true);
            $table->float('rpe_stab_min')->nullable($value = true);
            $table->float('rpe_stab_max')->nullable($value = true);
            $table->float('rpe_str_min')->nullable($value = true);
            $table->float('rpe_str_max')->nullable($value = true);
            $table->float('rpe_acc_min')->nullable($value = true);
            $table->float('rpe_acc_max')->nullable($value = true);
            $table->integer('plio_0')->nullable($value = true);
            $table->integer('plio_1')->nullable($value = true);
            $table->integer('wu_displacement')->nullable($value = true);
            $table->integer('displacement_plus')->nullable($value = true);
            $table->integer('mov_arti')->nullable($value = true);
            $table->integer('anti_flex_sup')->nullable($value = true);
            $table->integer('anti_flex_pro')->nullable($value = true);
            $table->integer('anti_flex_later')->nullable($value = true);
            $table->integer('anti_rotation')->nullable($value = true);
            $table->integer('anti_extension')->nullable($value = true);
            $table->integer('fe_hip')->nullable($value = true);
            $table->integer('knee_dom')->nullable($value = true);
            $table->integer('vert_push')->nullable($value = true);
            $table->integer('horiz_push')->nullable($value = true);
            $table->integer('vert_pull')->nullable($value = true);
            $table->integer('horiz_pull')->nullable($value = true);
            $table->integer('rotations')->nullable($value = true);
            $table->integer('burpee')->nullable($value = true);
            $table->integer('throwings')->nullable($value = true);
            $table->integer('pliometrico')->nullable($value = true);
            $table->integer('displacement')->nullable($value = true);
            $table->integer('step')->nullable($value = true);
            $table->integer('trx')->nullable($value = true);
            $table->integer('box')->nullable($value = true);
            $table->text('note')->nullable($value = true);
            $table->timestamps();

            $table->foreign('session_tab_id')->references('id')->on('session_tabs');
            $table->foreign('coach_id')->references('id')->on('profesionals');
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
        Schema::dropIfExists('cycles');
    }
}
