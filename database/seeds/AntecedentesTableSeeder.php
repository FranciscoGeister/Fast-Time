<?php

use Illuminate\Database\Seeder;

class AntecedentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('antecedentes')->insert([
          'nombre' => "Problemas cardiovasculares (corazón, circulación, etc.)"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Problemas respiratorios o pulmonares"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Problemas musculares, articulares o dolor de espalda"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Debilidad, mareos o pérdida de conciencia"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Alguna operación durante el último año"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Tendencia a variaciones rápidas de peso (ganar o perder)"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Embarazo en la actualidad o en los últimos 3 meses"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Problemas musculares, articulares o dolor de espalda"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Excesivos nervios o ansiedad, sin razón aparente"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Hipercolesterolemia"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Estrés"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Hipertensión o hipotensión"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Algún problema con el ejercicio físico"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Celulitis"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Problemas menstruales"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Insomnio"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Sobrepeso"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Hernias u otras afecciones que puedan verse agravadas con la práctica de ejercicio físico."
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Diabetes u otras alteraciones hormonales."
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Problemas digestivos (digestiones lentas, gases, estreñimiento)"
      ]);
      DB::table('antecedentes')->insert([
          'nombre' => "Recomendación médica de no realizar ejercicio físico"
      ]);
    }
}
