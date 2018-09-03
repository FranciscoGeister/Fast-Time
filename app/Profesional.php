<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class Profesional extends Model
{
  use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'first_name','last_name','mother_last_name',
      'celular','rut','tipo','email','color','avatar','huella',
      'nacimiento','link','contracted_hours','estado',
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'remember_token',
  ];

  public function sedes()
  {
      return $this->belongsToMany('App\Sede');
  }

  public function hours()
  {
    return $this->hasMany('App\Hora');
  }

  public function workingDays()
    {
      return $this->hasMany('App\WorkingDay');
    }

}
