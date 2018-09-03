<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Size;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        Size::create([
        'nombre' => 'XS'
        ]);
        Size::create([
        'nombre' => 'S'
        ]);
        Size::create([
        'nombre' => 'M'
        ]);
        Size::create([
        'nombre' => 'L'
        ]);
        Size::create([
        'nombre' => 'XL'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sizes');
    }
}
