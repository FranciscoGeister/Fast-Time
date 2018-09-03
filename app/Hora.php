<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Hora extends Model
{
  use Notifiable;
    protected $table = 'horas';
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'title','profesional','socio','start','end',
      'event_id','begin','finish','description','estado','color',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'remember_token',
  ];

  /**
   * Get the user that owns the hour.
   */
  public function member()
  {
      return $this->belongsTo('App\Member');
  }
  public function profesional()
  {
  return $this->belongsTo('App\Profesional');
  }

}
