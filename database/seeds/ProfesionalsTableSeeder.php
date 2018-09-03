<?php

use Illuminate\Database\Seeder;

class ProfesionalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profesionals')->insert([
          'first_name' => 'Pedro',
          'last_name' => 'Palma',
          'mother_last_name' => 'Dos Santos',
          'nacimiento' => '1980-02-22',
          'email' => 'pedropalma@fastfit.cl',
          'tipo' => '1',
          'celular' => '+569 12345678',
          'rut' => '11.111.111-1',
          'color' => '#013ADF'
        ]);

        $pedro = App\Profesional::where('email','pedropalma@fastfit.cl')->firstOrFail();
        DB::table('profesional_sede')->insert([
          'profesional_id' => $pedro->id,
          'sede_id' => 1,
        ]);
    }
}
