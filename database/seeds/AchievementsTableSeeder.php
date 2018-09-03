<?php

use Illuminate\Database\Seeder;

class AchievementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('achievements')->insert([
          'nombre' => "Primeros pasos",
          'descripcion' => "Completa 1 tarea"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Perfeccionista",
          'descripcion' => "Completa 10 tareas"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Profesional",
          'descripcion' => "Completa 20 tareas"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Maestro",
          'descripcion' => "Completa 40 tareas"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Comienza la historia",
          'descripcion' => "Asiste a una sesión de entrenamiento"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Una ayuda especial",
          'descripcion' => "Asiste a una sesión de nutricionista"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Recién llegado",
          'descripcion' => "Asiste a tu evaluación inicial"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Temerario",
          'descripcion' => "Asiste a una evaluación intermedia"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Veterano",
          'descripcion' => "Asiste a tu evaluación final"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Un buen compañero",
          'descripcion' => "Completa la encuesta inicial"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Iluminado",
          'descripcion' => "Completa la encuesta de datos personales"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Perseverante",
          'descripcion' => "No faltes a ninguna sesión"
      ]);
      DB::table('achievements')->insert([
          'nombre' => "Portador del poder",
          'descripcion' => "Completa todas tus sesiones"
      ]);
    }
}
