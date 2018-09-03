<?php

use Illuminate\Database\Seeder;
use App\Pathology;

class PathologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      Pathology::create([
        'nombre' => 'Molestias Cervicales'
      ]);
      Pathology::create([
        'nombre' => 'Molestias Dorsales'
      ]);
      Pathology::create([
        'nombre' => 'Molestias Lumbares'
      ]);
      Pathology::create([
        'nombre' => 'Art. escápulohumeral (hombro)'
      ]);
      Pathology::create([
        'nombre' => 'Art. húmerocubital o húmeroradial o radiocubital (codo)'
      ]);
      Pathology::create([
        'nombre' => 'Art. radiocúbitocarpiana o mediocarpiana (muñeca)'
      ]);
      Pathology::create([
        'nombre' => 'Art. coxofemoral (cadera)'
      ]);
      Pathology::create([
        'nombre' => 'Art. fémorotibial o fémoropatelar o tibioperoneal (rodilla)'
      ]);
      Pathology::create([
        'nombre' => 'Art. tibioperoneoastragalina (tobillo)'
      ]);
      Pathology::create([
        'nombre' => 'Hernias'
      ]);
      Pathology::create([
        'nombre' => 'Caries o mala oclusión dental'
      ]);
    }
}
