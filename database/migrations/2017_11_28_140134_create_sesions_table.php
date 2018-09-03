<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Sesion;

class CreateSesionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('estado');
            $table->integer('precio');
            $table->timestamps();
        });

        Sesion::create([
        'nombre' => 'Evaluación Inicial',
        'estado' => '1',
        'precio' => '0',
        ]);

        Sesion::create([
        'nombre' => 'Evaluación Intermedia',
        'estado' => '1',
        'precio' => '0',
        ]);

        Sesion::create([
        'nombre' => 'Evaluación Final',
        'estado' => '1',
        'precio' => '0',
        ]);

        Sesion::create([
        'nombre' => 'Entrenamiento',
        'estado' => '1',
        'precio' => '0',
        ]);

        Sesion::create([
        'nombre' => 'Cortesía',
        'estado' => '1',
        'precio' => '0',
        ]);
        Sesion::create([
        'nombre' => 'Nutricionista',
        'estado' => '1',
        'precio' => '20000',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesions');
    }
}
