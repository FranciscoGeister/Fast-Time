<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Objetive;

class CreateObjetivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });
        Objetive::create([
        'nombre' => 'Comp. Corporal'
        ]);
        Objetive::create([
        'nombre' => 'Condicíon Física'
        ]);
        Objetive::create([
        'nombre' => 'Prev./Comp.'
        ]);
        Objetive::create([
        'nombre' => 'Calidad de vida'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objetives');
    }
}
