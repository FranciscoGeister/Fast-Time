<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evaluation_sheet_id')->unsigned();
            $table->integer('profesional_id');
            $table->integer('tipo');
            $table->date('fecha');
            $table->time('hora');
            $table->float('peso')->nullable($value = true);
            $table->integer('circunferencia')->nullable($value = true);
            $table->integer('pliegues')->nullable($value = true);
            $table->integer('pecho')->nullable($value = true);
            $table->integer('tricipital')->nullable($value = true);
            $table->integer('cintura')->nullable($value = true);
            $table->integer('bicipital')->nullable($value = true);
            $table->integer('cont_iliaco')->nullable($value = true);
            $table->integer('subescapular')->nullable($value = true);
            $table->integer('cadera')->nullable($value = true);
            $table->integer('suprailiaco')->nullable($value = true);
            $table->integer('muslo')->nullable($value = true);
            $table->integer('bisep_der')->nullable($value = true);
            $table->integer('total_cont')->nullable($value = true);
            $table->integer('total_pliegues')->nullable($value = true);
            $table->timestamps();

            $table->foreign('evaluation_sheet_id')->references('id')->on('evaluation_sheets');
            $table->foreign('profesional_id')->references('id')->on('profesionals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation_sessions');
    }
}
