<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model{

	public $table = "person";
  public $timestamps = false;
  protected $fillable = array(
    'username',
    'user_id',
    'stable_name',
    'stable_prefix',
    'racing_colors'
    );
}
