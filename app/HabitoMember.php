<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HabitoMember extends Model
{
  protected $fillable = [
      'pregunta_id','member_id','respuesta'
  ];

  protected $table = 'preguntas_habitos_members';
}
