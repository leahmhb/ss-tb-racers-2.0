<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race_Entry extends Model{
  public $table = "race_entries";
  public $timestamps = false;
  protected $fillable = array(
    'race_id',
    'horse_id',
    'placing',
    'isTrackRecord',
    'isNotableWin',
    'time'
    );
}
