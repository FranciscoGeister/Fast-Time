<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CanceledSale extends Model
{
    use Notifiable;
/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
protected $fillable = [
    'member_id','sede_id','monto','boleta','iva','date','user_id','user2_id',
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
