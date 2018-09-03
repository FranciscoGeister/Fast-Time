<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
  protected $fillable = [
    'nombre','descripcion','icono'
  ];
  public function members()
  {
      return $this->belongsToMany('App\Member');
  }
}
