<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Exercise;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('sigla')->nullable($value = true);
            $table->string('video')->nullable($value = true);
            $table->string('foto')->nullable($value = true);
            $table->timestamps();
        });

        Exercise::create([
        'nombre' => 'Sentadilla',
        'sigla' => 'SE',
        ]);
        Exercise::create([
        'nombre' => 'Estocada',
        'sigla' => 'ES',
        ]);Exercise::create([
        'nombre' => 'Salto Vertical',
        'sigla' => 'SV',
        ]);Exercise::create([
        'nombre' => 'Elevación Talones',
        'sigla' => 'ET',
        ]);Exercise::create([
        'nombre' => 'Peso Muerto',
        'sigla' => 'PM',
        ]);Exercise::create([
        'nombre' => 'Balance 1 Pierna',
        'sigla' => '',
        ]);Exercise::create([
        'nombre' => 'Paso Lateral',
        'sigla' => 'PL',
        ]);Exercise::create([
        'nombre' => 'Subidas Banca (Subida Step)',
        'sigla' => 'SS',
        ]);Exercise::create([
        'nombre' => 'Remo (Remo Elástico)',
        'sigla' => 'RE',
        ]);Exercise::create([
        'nombre' => 'Press Hombro',
        'sigla' => 'PH',
        ]);Exercise::create([
        'nombre' => 'Vuelos Laterales',
        'sigla' => 'VL',
        ]);Exercise::create([
        'nombre' => 'Press Banco',
        'sigla' => 'PB',
        ]);Exercise::create([
        'nombre' => 'Push Up',
        'sigla' => 'PU',
        ]);Exercise::create([
        'nombre' => 'Pull Up',
        'sigla' => 'PLU',
        ]);Exercise::create([
        'nombre' => 'Pall Of Press',
        'sigla' => 'PFP',
        ]);Exercise::create([
        'nombre' => 'Biceps Flex. Codo',
        'sigla' => 'B',
        ]);Exercise::create([
        'nombre' => 'Plancha',
        'sigla' => 'P',
        ]);Exercise::create([
        'nombre' => 'Plancha Lateral',
        'sigla' => 'PL',
        ]);Exercise::create([
        'nombre' => 'Plancha En ',
        'sigla' => 'PT',
        ]);Exercise::create([
        'nombre' => 'Plancha 3 Apoyos',
        'sigla' => 'P3',
        ]);Exercise::create([
        'nombre' => 'Plancha 2 Apoyos',
        'sigla' => 'P2',
        ]);Exercise::create([
        'nombre' => 'Plancha Cuadrupedia',
        'sigla' => 'PC',
        ]);Exercise::create([
        'nombre' => 'Supino',
        'sigla' => 'So',
        ]);Exercise::create([
        'nombre' => 'Swing KB',
        'sigla' => 'Sw',
        ]);Exercise::create([
        'nombre' => 'Bird Dog',
        'sigla' => 'Bd',
        ]);Exercise::create([
        'nombre' => 'Puentes Supino',
        'sigla' => 'Ps',
        ]);Exercise::create([
        'nombre' => 'Ext. Cadera Prono',
        'sigla' => 'Ex.C',
        ]);Exercise::create([
        'nombre' => 'Empuje Cadera',
        'sigla' => 'Em.C',
        ]);Exercise::create([
        'nombre' => 'Skipping',
        'sigla' => 'SK',
        ]);Exercise::create([
        'nombre' => 'Salto Esquiador',
        'sigla' => 'SSK',
        ]);Exercise::create([
        'nombre' => 'Burpee',
        'sigla' => 'Bu',
        ]);Exercise::create([
        'nombre' => 'Escaleras',
        'sigla' => 'Esc',
        ]);Exercise::create([
        'nombre' => 'Salto Pie Junto',
        'sigla' => 'SBP',
        ]);Exercise::create([
        'nombre' => 'Marcha',
        'sigla' => 'M',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
}
