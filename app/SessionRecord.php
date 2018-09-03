<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Homework;

class SessionRecord extends Model
{
    use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'cycle_id','coach_id','date','rpe_stab','rpe_acc','rpe_wu','rpe_str','wu_o_1','wu_o_2','wu_o_3','wu_o_4','wu_s_1','wu_s_2','wu_s_3','wu_s_4','wu_r_1','wu_r_2','wu_r_3','wu_r_4','est_o_1','est_o_2','est_o_3','est_o_4','est_s_1','est_s_2','est_s_3','est_s_4','est_r_1','est_r_2','est_r_3','est_r_4','str_o_1','str_o_2','str_o_3','str_o_4','str_s_1','str_s_2','str_s_3','str_s_4','str_r_1','str_r_2','str_r_3','str_r_4','str_w_1','str_w_2','str_w_3','str_w_4','acc_o_1','acc_o_2','acc_o_3','acc_o_4','acc_s_1','acc_s_2','acc_s_3','acc_s_4','acc_r_1','acc_r_2','acc_r_3','acc_r_4','notes','session_tab_id','r_or_t_wu','r_or_t_est','r_or_t_str','r_or_t_acc',
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'remember_token',
  ];

  public function homeWorks()
    {
      return $this->hasMany('App\Homework');
    }
}
