<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Program;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('duracion');
            $table->integer('valor');
            $table->integer('sesiones');
            $table->integer('sesi_semanal');
            $table->integer('sesi_nutri');
            $table->integer('estado');
            $table->text('descripcion')->nullable($value = true);
            $table->timestamps();
        });
        Program::create([
            'nombre' => 'opción 1',
            'duracion' => '100',
            'valor' => '599000',
            'sesiones' => '26',
            'sesi_semanal' => '1',
            'sesi_nutri' => '3',
            'estado' => '1',
        ]);
        Program::create([
            'nombre' => 'opción 2',
            'duracion' => '210',
            'valor' => '1090000',
            'sesiones' => '52',
            'sesi_semanal' => '1',
            'sesi_nutri' => '5',
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
        Schema::dropIfExists('programs');
    }
}
