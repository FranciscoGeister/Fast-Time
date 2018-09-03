<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class Event extends Model
{
  /**
   * [$table description]
   * @var string
   */
  protected $table = 'events';
   /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
   protected $fillable = [
     'title',
     'profesional',
     'start',
     'end',
     'begin',
     'finish',
     'state',
     'color',
     'type',
     'id_prof',
     'description',
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
       'remember_token',
   ];

   public function sedes()
   {
       return $this->belongsToMany('App\Sede');
   }
}
