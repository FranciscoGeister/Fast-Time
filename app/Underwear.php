<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Underwear extends Model
{
    use Notifiable;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'nombre','marca','stock','stock_critico',
      'id_sucursal','precio','precio_arriendo','talla','estado',
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'remember_token',
  ];
}
