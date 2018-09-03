<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
  protected $fillable = [
    'nombre'
  ];
  public function members()
  {
      return $this->belongsToMany('App\Member');
  }
}
