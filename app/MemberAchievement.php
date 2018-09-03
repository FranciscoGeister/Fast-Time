<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberAchievement extends Model
{
  protected $fillable = [
    'achievement_id','member_id'
  ];
}
