<?php

use Illuminate\Database\Seeder;
use App\PreguntaHabito;

class PreguntasHabitosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PreguntaHabito::create([
            'pregunta' => '¿Has practicado anteriormente algún deporte o actividad no competitiva? ¿Cuál?',
            'tipo' => 'vida'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Con qué frecuencia, cuántas horas y cuantos años lo hiciste?',
          'tipo' => 'vida'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Has practicado anteriormente algún deporte a nivel de competición? ¿Cuál?',
          'tipo' => 'vida'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Con qué frecuencia, cuántas horas y cuantos años lo hiciste?',
          'tipo' => 'vida'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Has entrenado alguna vez en un centro de fitness o con un entrenador personal?',
          'tipo' => 'vida'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Por qué dejaste de asistir?',
          'tipo' => 'vida'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Con qué frecuencia, cuántas horas y cuantos años lo hiciste?',
          'tipo' => 'vida'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Tienes alguna sensación negativa hacia el ejercicio o has tenido alguna experiencia negativa durante la práctica de
ejercicio físico?',
          'tipo' => 'vida'
        ]);
        PreguntaHabito::create([
          'pregunta' => 'Profesión',
          'tipo' => 'laboral'
        ]);
        PreguntaHabito::create([
          'pregunta' => 'Haz una breve descripción de tu actividad laboral (exigencias físicas, posturales, etc.)',
          'tipo' => 'laboral'
        ]);
        PreguntaHabito::create([
          'pregunta' => 'Esfuerzo físico que comporta tu actividad laboral o estudios',
          'tipo' => 'laboral'
        ]);
        PreguntaHabito::create([
          'pregunta' => 'Indica la actividad física que realizas en tu tiempo de ocio',
          'tipo' => 'laboral'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Has fumado alguna vez cigarrillos, puros o en pipa?',
          'tipo' => 'salud'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Fumas en la actualidad? ¿Cuántos por día?',
          'tipo' => 'salud'
        ]);
        PreguntaHabito::create([
          'pregunta' => 'Si has dejado de fumar, ¿Cuándo fue?',
          'tipo' => 'salud'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Tomas alguna droga o sustancia perjudicial para la salud? (Esteroides, anabolizantes, diuréticos, drogas estimulantes)',
          'tipo' => 'salud'
        ]);
        PreguntaHabito::create([
          'pregunta' => 'Con que regularidad consumes dicha sustancia ?',
          'tipo' => 'salud'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Mantienes algún tipo de dieta? ¿Cuál?',
          'tipo' => 'nutricion'
        ]);
        PreguntaHabito::create([
          'pregunta' => '¿Cuántas veces come al día?',
          'tipo' => 'nutricion'
        ]);
    }
}
