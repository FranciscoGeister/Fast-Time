<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    use Notifiable;
/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
protected $fillable = [
    'nombre','paterno','materno',
    'rut','email','estado',
    'tipo','nacimiento', 'avatar', 'huella',
    'celular','sexo','id_sucursal','password',
    'want_info',
];
/**
	* The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
      'remember_token',
  	];


    /**
     * Get the hours for the User.
     */
    public function comments()
    {
        return $this->hasMany('App\Hora');
    }

    public function hours()
    {
      return $this->hasMany('App\Hora');
    }

    public function campañas(){
      return $this->belongsToMany('App\Campaign','campaigns_members','member_id','campaign_id');
    }

    public function patologias(){
      return $this->belongsToMany('App\Pathology','pathologies_members','member_id','pathology_id');
    }
    public function antecedentes(){
      return $this->belongsToMany('App\Antecedente','antecedentes_member','member_id','antecedente_id');
    }

    public function respuestas(){
      $preguntas = $this->belongsToMany('App\PreguntaMedica','preguntas_members','member_id','pregunta_id');
      return $preguntas;
    }

    public function tareas(){
      return $this->belongsToMany('App\Exercise','homeworks','member_id','exercise_id');
    }
    public function achievements(){
      return $this->belongsToMany('App\Achievement','member_achievements','member_id','achievement_id');
    }
    public function habitos(){
      return $this->belongsToMany('App\PreguntaHabito','preguntas_habitos_members','member_id','pregunta_id');
    }


}
