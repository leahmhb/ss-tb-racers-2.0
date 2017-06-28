<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models as Model;
use View;
use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  public function __construct()
  {

  }
/*
|--------------------------------------------------------------------------
| Navigation
|--------------------------------------------------------------------------
*/
public static function nav($main_active = false, $sub_active = false){

  $mainbar = array(
    'guides' => array(
      'label' => 'Guides',
      'icon' => 'fa ',
      'url' => '/',
      'dropdown' => true,
      'visible' => true
      ),
    'tables' => array(
      'label' => 'Tables',
      'icon' => 'fa ',
      'url' => '/',
      'dropdown' => true,
      'visible' => true
      ),
    'forms' => array(
      'label' => 'Forms',
      'icon' => 'fa ',
      'url' => '/',
      'dropdown' => true,
      'visible' => false
      ),
    );

  $subbar = array(
    'guides' => array(
      'guide_getting_started' => array(
        'label' => 'Getting Started',
        'icon' => 'fa ',
        'url' => url('/guide_getting_started'),
        'visible' => true
        ),
      'guide_breeding' => array(
       'label' => 'Breeding',
       'icon' => 'fa ',
       'url' => url('/guide_breeding'),
       'visible' => true
       ),
      'guide_colors' => array(
       'label' => 'Colors',
       'icon' => 'fa ',
       'url' => url('/guide_colors'),
       'visible' => true
       ),
      'guide_stats' => array(
        'label' => 'Stats',
        'icon' => 'fa ',
        'url' => url('/guide_stats'),
        'visible' => true
        ),
      'guide_abilities' => array(
        'label' => 'Abilities',
        'icon' => 'fa ',
        'url' => url('/guide_abilities'),
        'visible' => true
        ),
      'guide_form' => array(
        'label' => 'Entry Form Generator',
        'icon' => 'fa ',
        'url' => url('/guide_form'),
        'visible' => true
        ),
      ),
    'tables' => array(
      'person_table' => array(
       'label' => 'Person Table',
       'icon' => 'fa ',
       'url' => url('/person-table'),
       'visible' => true
       ),
      'horse_table' => array(
       'label' => 'Horse Table',
       'icon' => 'fa ',
       'url' => url('/horse-table'),
       'visible' => true
       ),
      'race_table' => array(
       'label' => 'Race Table',
       'icon' => 'fa ',
       'url' => url('/race-table'),
       'visible' => true
       ),
      'entry_table' => array(
       'label' => 'Entry Table',
       'icon' => 'fa ',
       'url' => url('/entry-table'),
       'visible' => true
       ),
      ),
    'forms' => array(
      'person' => array(
       'label' => 'Create Person',
       'icon' => 'fa ',
       'url' => url('/person'),
       'visible' => true
       ),
      'horse' => array(
       'label' => 'Create Horse',
       'icon' => 'fa ',
       'url' => url('/horse'),
       'visible' => true
       ),
      'race' => array(
       'label' => 'Create Race',
       'icon' => 'fa ',
       'url' => url('/race'),
       'visible' => true
       ),
      'entry' => array(
       'label' => 'Create Entry',
       'icon' => 'fa ',
       'url' => url('/entry'),
       'visible' => true
       ),
      ),
    );

  $nav = array(
    'mainbar'=> $mainbar,
    'subbar'=>$subbar
    );

  $nav['mainbar']['forms']['visible'] = true;
  $nav['person'] = Users::getPerson();

  return $nav;
}
/*
|--------------------------------------------------------------------------
| Table Controls
|--------------------------------------------------------------------------
*/
public function person_table(){
  $person = Person::person_table_data();
  $users = Users::user_table_data();
  $pl = (Users::verifyAdmin() ? 'true' : 'false');
  return View('tables.person', ['person' => $person, 'users' => $users, 'pl' => $pl]);
}
/*
|--------------------------------------------------------------------------
| Domain Controls
|--------------------------------------------------------------------------
*/
public function getDomainID($domain, $value){
  return Model\Domain_Value::where('domain', $domain)
  ->where('value', $value)
  ->first()
  ->toArray()['id'];
}

public function getHorseDomain(){
  $domain = [];
  $domain['grades'] = Model\Domain_Value::where('domain', 'GRADE')
  ->whereNotIn('value', ['All'])
  ->get();
  $domain['breeding_status'] = Model\Domain_Value::where('domain', 'BREEDING_STATUS')->get();
  $domain['leg_types'] = Model\Domain_Value::where('domain', 'LEG_TYPE')
  ->orderBy('id')
  ->get();
  $domain['sexes'] = Model\Domain_Value::where('domain', 'SEX')->get();
  $domain['surface_pref'] = Model\Domain_Value::where('domain', 'SURFACE_PREF')->get();
  $domain['bandages'] = Model\Domain_Value::where('domain', 'BANDAGES')
  ->orderBy('id')
  ->get();
  $domain['shadow_roll'] = Model\Domain_Value::where('domain', 'SHADOW_ROLL')
  ->orderBy('id', 'desc')
  ->get();
  $domain['neck_height'] = Model\Domain_Value::where('domain', 'NECK_HEIGHT')->get();
  $domain['run_style'] = Model\Domain_Value::where('domain', 'RUN_STYLE')->get();
  $domain['hood'] = Model\Domain_Value::where('domain', 'HOOD')
  ->orderBy('id')
  ->get();
  $domain['person'] = Model\Person::orderBy('username', 'asc')->get();
  $domain['pos_abilities'] = Model\Ability::where('type', 'positive')
  ->orderBy('ability', 'asc')
  ->get();
  $domain['neg_abilities'] = Model\Ability::where('type', 'negative')
  ->orderBy('ability', 'asc')
  ->get();
  $domain['sires'] = Model\Horse::select('id', 'call_name')
  ->where('sex', $this->getDomainID('SEX', 'Stallion'))
  ->orderBy('call_name')
  ->get();
  $domain['dams'] = Model\Horse::select('id', 'call_name')
  ->where('sex', $this->getDomainID('SEX', 'Mare'))
  ->orderBy('call_name')
  ->get();

  return $domain;
}

public function getRaceDomain($person_id = false){
  $domain = [];
  $horses = Model\Horse::select('id', 'call_name')
  ->orderBy('call_name');
  if($person_id){
    $horses = $horses->where('owner', 'like', $person_id);
  }
  $domain['my_horses'] = $horses->get()->toArray();

  $domain['series'] =  Model\Domain_Value::where('domain', 'RACE_SERIES')
  ->orderBy('value')
  ->get();
  $domain['grades'] = Model\Domain_Value::where('domain', 'GRADE')->get();
  $domain['surfaces'] = Model\Domain_Value::where('domain', 'SURFACE')->get();

  $races = Model\Race::select(
    'id',
    'name',
    'grade',
    'surface',
    'series',
    'distance',
    'ran_dt')
  ->orderBy('name')
  ->get()
  ->toArray();

  foreach($races as $i=>$r){
   $races[$i]['series'] = $this->getSeriesValue($domain['series'], $r['series']);
   $races[$i]['surface'] = ($r['surface'] == $this->getDomainID('SURFACE', 'Dirt') ? 'Dirt' : 'Turf');
   $races[$i]['grade'] = $this->getGrade($domain['grades'], $r['grade']);
 }

 $domain['races'] = $races;

 return $domain;
}

public static function getRace($d_race, $race){
  foreach($d_race as $s){
    if($s['id'] == $race){
      return $s;
    }
  }
  return '';
}


public static function getSeriesValue($d_series, $series){
  foreach($d_series as $s){
    if($s['id'] == $series && $series != 44){
      //return ['value' => $s['value'], 'description' => $s['description']];
      return '[' . $s['value'] . ']';
    }
  }
  return '';
}

public static function getSeriesDescription($d_series, $series){
  foreach($d_series as $s){
    if($s['id'] == $series && $series != 44){
      //return ['value' => $s['value'], 'description' => $s['description']];
      return $s['description'];
    }
  }
  return '';
}


public static function getGrade($d_grade, $grade){
  foreach($d_grade as $s){
    if($s['id'] == $grade){
      return $s['value'];
    }
  }
  return '';
}


/*
|--------------------------------------------------------------------------
| Page Controls
|--------------------------------------------------------------------------
*/
public function index(){
  return view('pages.index');
}

public function credits(){
  return view('pages.credits');
}

public function contact(){
  return view('pages.contact');
}
/*
|--------------------------------------------------------------------------
| Guide Controls
|--------------------------------------------------------------------------
*/
public function guide_getting_started(){
  return view('guides.getting_started');
}

public function guide_breeding(){
  return view('guides.breeding');
}

public function guide_colors(){
  return view('guides.colors');
}

public function guide_stats(){
  return view('guides.stats');
}

public function guide_abilities(){
  return view('guides.abilities');
}

public function guide_form(){
  return view('guides.form',['domain' => $this->getHorseDomain()]);
}

public function guide_form_result(){
  $data = $this->trimWhiteSpace($_POST);
  return view('guides.form_result', ['data' => $data]);
}

/*
|--------------------------------------------------------------------------
| Utility Controls
|--------------------------------------------------------------------------
*/
public static function trimWhiteSpace($data){
  foreach($data as $i=>$d){
    $data[$i] = trim(htmlspecialchars($d, ENT_QUOTES));
  }
  return $data;
}

public static function output($a){
  echo "<pre>" . print_r($a, true) . "</pre>";
  exit;
}

public static function ordinal($number) {
  $ends = array('th','st','nd','rd','th','th','th','th','th','th');
  if ((($number % 100) >= 11) && (($number%100) <= 13))
    return $number. 'th';
  else
    return $number. $ends[$number % 10];
}

}


