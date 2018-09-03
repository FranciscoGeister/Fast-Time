<?php

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('campaigns')->insert([
          'nombre' => "Campaña Especial",
          'mensaje' => "Sumate a la nueva campaña de FastFit",
          'imagen' => str_random(10).'.jpg',
          'descripcion' => "La nueva campaña de prueba"
      ]);
    }
}
