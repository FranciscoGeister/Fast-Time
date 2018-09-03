<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\ProgramType;

class CreateProgramTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        ProgramType::create([
        'nombre' => 'Metabólico'
        ]);
        ProgramType::create([
        'nombre' => 'Tonificación'
        ]);
        ProgramType::create([
        'nombre' => 'Percepción'
        ]);
        ProgramType::create([
        'nombre' => 'Recuperación'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_types');
    }
}
