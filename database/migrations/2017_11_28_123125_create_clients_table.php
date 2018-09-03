<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Client;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('estado');
            $table->timestamps();
        });

        Client::create([
       'nombre' => 'Socio',
       'estado' => '1',
       ]);

        Client::create([
       'nombre' => 'Embajador',
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
        Schema::dropIfExists('clients');
    }
}
