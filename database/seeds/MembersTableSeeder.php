<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('members')->insert([
          'nombre' => 'Diego',
          'paterno' => 'Rodriguez',
          'materno' => 'Mancini',
          'rut' => '18.812.098-9',
          'email' => 'drodriguezm@udec.cl',
          'celular' => '78571993',
          'tipo' => 1,
          'nacimiento' => '1995-01-13',
          'estado' => 3,
          'sexo' => 'masculino',
          'id_sucursal' => 1,
          'password' => bcrypt('vicente'),
          'avatar' => 'imagen.png',
          'huella' => '10101110001000',
          'want_info' => 1,
      ]);
    }
}
