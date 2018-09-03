<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntecedenteMember extends Model
{
  protected $fillable = [
      'antecedente_id','member_id'
  ];

  protected $table = 'antecedentes_member';
}
