<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Activity;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });
        Activity::create([
        'nombre' => 'Sedentaria'
        ]);
        Activity::create([
        'nombre' => 'Act. I'
        ]);
        Activity::create([
        'nombre' => 'Act. II'
        ]);
        Activity::create([
        'nombre' => 'Deportista'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
