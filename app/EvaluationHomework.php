<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EvaluationHomework extends Model
{
    use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'member_id','exercise_id','series','repetitions','comment','profesional_id',
      'evaluation_session_id','evaluation_sheet_id','rest', 'completed'
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
  public function members()
  {
      return $this->belongsToMany('App\Member');
  }
}