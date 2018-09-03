<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PathologyMember extends Model
{
  protected $fillable = [
      'pathology_id','member_id'
  ];

  protected $table = 'pathologies_members';
}
