<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntaHabito extends Model
{
  /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
  protected $fillable = [
    'pregunta','tipo'
  ];

  protected $table = 'preguntas_habitos';
/**
* The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'remember_token',
  ];
}
