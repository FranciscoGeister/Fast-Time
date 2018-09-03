<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('marca');
            $table->date('vencimiento');
            $table->integer('stock');
            $table->integer('stock_critico');
            $table->integer('id_sucursal')->unsigned();
            $table->integer('precio');
            $table->string('um');
            $table->integer('estado');
            $table->text('descripcion')->nullable($value = true);
            $table->timestamps();

            //$table->primary('id','id_sucursal');
            $table->foreign('id_sucursal')->references('id')->on('sedes');
        });

        Product::create([
        'nombre' => 'Barra proteina chocolate',
        'marca' => 'marca',
        'vencimiento' => '2017-12-28',
        'stock' => '20',
        'stock_critico' => '0',
        'id_sucursal' => '1',
        'precio' => '500',
        'um' => 'grs.',
        'estado' => '7',
        ]);
        Product::create([
        'nombre' => 'Barra proteina chocolate',
        'marca' => 'marca',
        'vencimiento' => '2017-12-28',
        'stock' => '10',
        'stock_critico' => '0',
        'id_sucursal' => '2',
        'precio' => '500',
        'um' => 'grs.',
        'estado' => '7',
        ]);
        Product::create([
        'nombre' => 'Barra proteina vainilla',
        'marca' => 'marca',
        'vencimiento' => '2017-12-28',
        'stock' => '30',
        'stock_critico' => '0',
        'id_sucursal' => '1',
        'precio' => '500',
        'um' => 'grs.',
        'estado' => '7',
        ]);
        Product::create([
        'nombre' => 'Barra proteina vainilla',
        'marca' => 'marca',
        'vencimiento' => '2017-12-28',
        'stock' => '0',
        'stock_critico' => '0',
        'id_sucursal' => '2',
        'precio' => '500',
        'um' => 'grs.',
        'estado' => '7',
        ]);
        Product::create([
        'nombre' => 'Barra proteina vainilla',
        'marca' => 'marca',
        'vencimiento' => '2017-12-28',
        'stock' => '0',
        'stock_critico' => '0',
        'id_sucursal' => '3',
        'precio' => '500',
        'um' => 'grs.',
        'estado' => '7',
        ]);
        Product::create([
        'nombre' => 'Shake Ice coffee',
        'marca' => 'marca',
        'vencimiento' => '2017-12-28',
        'stock' => '4',
        'stock_critico' => '0',
        'id_sucursal' => '1',
        'precio' => '1200',
        'um' => 'ml.',
        'estado' => '7',
        ]);
        Product::create([
        'nombre' => 'Shake Ice coffee',
        'marca' => 'marca',
        'vencimiento' => '2017-12-28',
        'stock' => '16',
        'stock_critico' => '0',
        'id_sucursal' => '2',
        'precio' => '1200',
        'um' => 'ml.',
        'estado' => '7',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
