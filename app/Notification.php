<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $fillable = [
    'name','message','schedule','url'
  ];

  public function miembros(){
    return $this->belongsToMany('App\Member', 'notification_members', 'notification_id', 'member_id');
  }
}
