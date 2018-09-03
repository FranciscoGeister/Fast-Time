<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\MemberHasSesion;
use App\Member;

class MemberHasPlan extends Model
{
    use Notifiable;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    'member_id','plan_id','inicio','vencimiento', 'plan_or_prog',
    'contrato','active','comen_venc','new','estado',
    ];
/**
	* The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
      'remember_token',
  	];

    public function sessions()
    {
        return $this->hasMany('App\MemberHasSesion');
    }

}
