<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\SessionRecord;
use App\Cycle;
use App\Homework;

class SessionTab extends Model
{
    use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'member_has_plan_id',
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'remember_token',
  ];

  public function sessionRecords()
    {
      return $this->hasMany('App\SessionRecord');
    }

  public function cycles()
    {
      return $this->hasMany('App\Cycle');
    }
  public function homeWorks()
    {
      return $this->hasMany('App\Homework');
    }
}
