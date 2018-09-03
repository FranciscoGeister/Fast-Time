<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;
/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
protected $fillable = [
    'nombre','marca','stock',
    'id_sucursal','precio','vencimiento','um','estado',
    'descripcion','stock_critico',
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
