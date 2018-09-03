<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
  protected $fillable = [
    'mensaje','imagen','nombre','descripcion'
  ];

  public function miembros(){
    return $this->belongsToMany('App\Member', 'campaigns_socios', 'member_id', 'campaign_id');
  }



}
