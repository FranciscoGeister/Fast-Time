<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignMember extends Model
{
  protected $table = 'campaigns_members';
  protected $fillable = [
    'campaign_id','member_id'
  ];
}
