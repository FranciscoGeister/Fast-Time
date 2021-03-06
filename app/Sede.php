<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Sede extends Model
{
  use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'codigo','nombre','direccion','lat','long',
      'ciudad','fono','type',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'remember_token',
  ];

  public function profesionals()
  {
    return $this->belongsToMany('App\Profesional');
  }

  public function events()
  {
    return $this->belongsToMany('App\Event');
  }

}
