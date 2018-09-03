<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntaMember extends Model
{
  protected $fillable = [
      'pregunta_id','member_id','respuesta'
  ];

  protected $table = 'preguntas_members';


}
