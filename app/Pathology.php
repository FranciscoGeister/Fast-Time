<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pathology extends Model
{
    use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'nombre'
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'remember_token',
  ];

  public function miembros(){
    return $this->belongsToMany('App\Member', 'pathologies_members', 'member_id', 'pathology_id');
  }
}
