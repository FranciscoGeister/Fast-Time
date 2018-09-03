<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cycle extends Model
{
    use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'coach_id','member_id','session_tab_id','date','metabolic','tonification','recuperation','cycle_obj',
      'stabilization','acc_metab','strength','warm_up_time','stabilization_time',
      'strength_time','acc_metab_time','rpe_wu_min','rpe_wu_max','rpe_stab_min','rpe_stab_max','rpe_str_min',
      'rpe_str_max','rpe_acc_min','rpe_acc_max','plio_0','plio_1','wu_displacement','displacement_plus',
      'mov_arti','anti_flex_sup','anti_flex_pro','anti_flex_later','anti_rotation',
      'anti_extension','fe_hip','knee_dom','vert_push','horiz_push','vert_pull',
      'horiz_pull','rotations','burpee','throwings','pliometrico','displacement',
      'step','trx','box','note',
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
