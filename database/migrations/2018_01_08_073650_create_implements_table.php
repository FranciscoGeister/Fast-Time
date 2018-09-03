<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Implement;

class CreateImplementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('implements', function (Blueprint $table) {
            $table->increments('id');
             $table->string('nombre');
            $table->string('sigla')->nullable($value = true);
            $table->timestamps();
        });

        Implement::create([
        'nombre' => 'Kettlebell',
        'sigla' => 'KE',
        ]);
        Implement::create([
        'nombre' => 'TRX',
        'sigla' => 'TRX',
        ]);
        Implement::create([
        'nombre' => 'Fitball',
        'sigla' => 'FB',
        ]);
        Implement::create([
        'nombre' => 'Mancuerna',
        'sigla' => 'MC',
        ]);
        Implement::create([
        'nombre' => 'Step',
        'sigla' => 'ST',
        ]);
        Implement::create([
        'nombre' => 'Disco',
        'sigla' => 'DC',
        ]);
        Implement::create([
        'nombre' => 'Bosu',
        'sigla' => 'BO',
        ]);
        Implement::create([
        'nombre' => 'Elástico',
        'sigla' => 'E',
        ]);
        Implement::create([
        'nombre' => 'Rueda',
        'sigla' => 'R',
        ]);
        Implement::create([
        'nombre' => 'Barra',
        'sigla' => 'B',
        ]);
        Implement::create([
        'nombre' => 'Balón Medicinal',
        'sigla' => 'BM',
        ]);
        Implement::create([
        'nombre' => 'Guante Boxeo',
        'sigla' => 'GB',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('implements');
    }
}
