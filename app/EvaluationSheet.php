<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\EvaluationHomework;

class EvaluationSheet extends Model
{
    use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'member_has_plan_id','meta_entrenamiento','hist_medic',
    ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'remember_token',
  ];

  public function evaluationSessions()
    {
        return $this->hasMany('App\EvaluationSession');
    }

  public function homeWorks()
  {
    return $this->hasMany('App\EvaluationHomework');
  }
}
