<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Plan;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('duracion');
            $table->integer('valor');
            $table->integer('sesiones');
            $table->integer('sesi_semanal');
            $table->integer('estado');
            $table->text('descripcion')->nullable($value = true);
            $table->timestamps();
        });

        Plan::create([
            'nombre' => '1x4',
            'duracion' => '30',
            'valor' => '112000',
            'sesiones' => '4',
            'sesi_semanal' => '1',
            'estado' => '1',
        ]);
        Plan::create([
            'nombre' => '1x8',
            'duracion' => '30',
            'valor' => '208000',
            'sesiones' => '8',
            'sesi_semanal' => '2',
            'estado' => '1',
        ]);
        Plan::create([
            'nombre' => '3x13',
            'duracion' => '95',
            'valor' => '312000',
            'sesiones' => '13',
            'sesi_semanal' => '1',
            'estado' => '1',
        ]);
        Plan::create([
            'nombre' => '3x26',
            'duracion' => '100',
            'valor' => '572000',
            'sesiones' => '26',
            'sesi_semanal' => '2',
            'estado' => '1',
        ]);
        Plan::create([
            'nombre' => '6x26',
            'duracion' => '195',
            'valor' => '572000',
            'sesiones' => '26',
            'sesi_semanal' => '1',
            'estado' => '1',
        ]);        
        Plan::create([
            'nombre' => '6x52',
            'duracion' => '210',
            'valor' => '1040000',
            'sesiones' => '52',
            'sesi_semanal' => '2',
            'estado' => '1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
