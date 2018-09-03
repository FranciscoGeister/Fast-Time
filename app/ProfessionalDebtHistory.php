<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProfessionalDebtHistory extends Model
{
    use Notifiable;
/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
protected $fillable = [
    'amount','profesional_id',
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
