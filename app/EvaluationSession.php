<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EvaluationSession extends Model
{
    use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'evaluation_sheet_id','fecha','hora','peso',
      'circunferecia','pliegues','pecho','tricipital',
      'cintura','bicipital','cont_iliaco','subescapular',
      'cadera','suprailiaco','muslo','bisep_der','total_cont',
      'tipo','profesional_id','total_pliegues',
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
