<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationMember extends Model
{
  protected $fillable = [
    'notification_id','member_id'
  ];
}
