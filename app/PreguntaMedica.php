<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntaMedica extends Model
{
    protected $fillable = [
        'pregunta'
    ];
    protected $table = 'preguntas_medicas';

    public function miembros(){
      return $this->belongsToMany('App\Member', 'preguntas_members', 'member_id', 'pregunta_id');
    }
}
