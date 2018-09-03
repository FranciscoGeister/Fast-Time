<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WorkingDay extends Model
{
        use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'profesional_id','date','sede_id','start','end','hours_worked',
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
