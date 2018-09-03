<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Plan extends Model
{
    use Notifiable;
/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
protected $fillable = [
    'nombre','duracion','valor',
    'sesiones','sesi_semanal','estado',
    'descripcion',
];
/**
	* The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
      'remember_token',
  	];
}
