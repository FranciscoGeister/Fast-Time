<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Payment;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('estado');
            $table->timestamps();
        });

        Payment::create([
        'nombre' => 'Efectivo',
        'estado' => '1',
        ]);

        Payment::create([
        'nombre' => 'Cheque',
        'estado' => '1',
        ]);

        Payment::create([
        'nombre' => 'Tarjeta de Crédito',
        'estado' => '1',
        ]);

        Payment::create([
        'nombre' => 'Tarjeta de Débito',
        'estado' => '1',
        ]);

        Payment::create([
        'nombre' => 'Canje',
        'estado' => '1',
        ]);

        Payment::create([
        'nombre' => 'Transferencia Bancaria',
        'estado' => '1',
        ]);

        Payment::create([
        'nombre' => 'Deuda',
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
        Schema::dropIfExists('payments');
    }
}
