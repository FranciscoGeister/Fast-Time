<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
  use Notifiable;
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
  'id_socio','amigo','nos_revista','tell_revista','datos_revista',
  'el_sur_revista','otra_revista','tv','pantalla','flyer',
  'facebook','otras_redes','otro',
  ];
}
