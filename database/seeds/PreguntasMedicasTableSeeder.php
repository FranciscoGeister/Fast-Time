<?php

use Illuminate\Database\Seeder;
use App\PreguntaMedica;

class PreguntasMedicasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      PreguntaMedica::create([
        'pregunta' => '¿ Cuándo pasaste por última vez una revisión médica ?'
      ]);
      PreguntaMedica::create([
        'pregunta' => '¿ Eres alérgico a medicamentos, alimentos u otras sustancias ? ¿ A cúales ?'
      ]);
      PreguntaMedica::create([
        'pregunta' => '¿ Padeces alguna enfermedad crónica o importante ? Indica cual'
      ]);
      PreguntaMedica::create([
        'pregunta' => '¿ Estás tomando en la actualidad algún medicamento ? ¿ Cuál ?'
      ]);
    }
}
