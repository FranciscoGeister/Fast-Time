<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Sede;
class CreateSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('sedes', function (Blueprint $table) {
             $table->increments('id');
             $table->string('codigo');
             $table->string('nombre', 60);
             $table->string('direccion', 80);
             $table->float('lat')->nullable();
             $table->float('long')->nullable();
             $table->string('ciudad');
             $table->string('fono')->nullable();
             $table->string('type')->nullable();
             $table->timestamps();
         });

         Sede::create([
        'codigo' => '555',
        'nombre' => 'Villuco',
        'direccion' => 'Ignacio Verdugo 77, Strip Paseo Villuco.',
        'ciudad' => 'Villuco',
        'fono' => '+56 413 830 369',
        ]);
        Sede::create([
       'codigo' => '678',
       'nombre' => 'Concepción',
       'direccion' => 'O’Higgins 241, Of. 604.',
       'ciudad' => 'Concepción',
       'fono' => '+56 412 921 647',
       ]);
        Sede::create([
       'codigo' => '333',
       'nombre' => 'San Pedro de la Paz',
       'direccion' => 'Camino el Venado 560.',
       'ciudad' => 'San Pedro de la Paz',
       'fono' => '+56 413 832 338',
       ]);


     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes');
    }
}
