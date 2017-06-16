<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Race extends Model{
  public $table = "races";
  public $timestamps = false;

  protected $fillable = array(
    'series',
    'name',
    'surface',
    'distance',
    'ran_dt',
    'grade',
    'url',
    'weather',
    'course',
    'final_time'
    );

  public function getRanDtAttribute($date){ 
    $dt = Carbon::parse($date);
    return $dt->year . '-' . $dt->month . '-' . $dt->day;
  }


}
