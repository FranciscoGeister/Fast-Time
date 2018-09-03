<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductEntry extends Model
{
    use Notifiable;
/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
protected $fillable = [
    'boleta','cant_agregar','comentario',
    'id_user','id_product','id_sucursal', 'tipo',
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
