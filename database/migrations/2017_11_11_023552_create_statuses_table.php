<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Status;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        Status::create([
        'nombre' => 'Atendido'
        ]);
        Status::create([
        'nombre' => 'Suspendida'
        ]);
        Status::create([
        'nombre' => 'Activo'
        ]);
        Status::create([
        'nombre' => 'Inactivo'
        ]);
        Status::create([
        'nombre' => 'Perdida'
        ]);
        Status::create([
        'nombre' => 'Bloqueada'
        ]);
        Status::create([
        'nombre' => 'Disponible'
        ]);
        Status::create([
        'nombre' => 'No disponible'
        ]);
        Status::create([
        'nombre' => 'Confirmada'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
