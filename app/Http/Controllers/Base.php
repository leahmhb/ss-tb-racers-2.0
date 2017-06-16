<?php
namespace App\Http\Controllers;
use App\Models as Models;

use View;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Base extends Controller{

  public function __construct(){
    // View::composers(['App\Composers\HomeComposer'  => 
    //   [
    //   'layout.*', 
    //   'includes.*', 
    //   'forms.*',      
    //   'pages.*',
    //   'guides.*',  
    //   'tables.*',
    //   'errors.*'
    //   ]]);
  }

/*
|--------------------------------------------------------------------------
| Table Controls
|--------------------------------------------------------------------------
*/
public function people_tables(){
  $person = Person::person_table_data();
  $users = Users::user_table_data();
  $pl = (Users::verifyAdmin() ? 'true' : 'false');
  return View('tables.people', ['person' => $person, 'users' => $users, 'pl' => $pl]);
}
/*
|--------------------------------------------------------------------------
| Domain Controls
|--------------------------------------------------------------------------
*/
public function getHorseDomain(){
  $domain = [];
  $domain['grades'] = Models\Domain_Value::where('domain', 'GRADE')->whereNotIn('value', ['All'])->get();
  $domain['breeding_status'] = Models\Domain_Value::where('domain', 'BREEDING_STATUS')->get();
  $domain['leg_types'] = Models\Domain_Value::where('domain', 'LEG_TYPE')->orderBy('id')->get();
  $domain['sexes'] = Models\Domain_Value::where('domain', 'SEX')->get();    
  $domain['surface_pref'] = Models\Domain_Value::where('domain', 'SURFACE_PREF')->get();    
  $domain['bandages'] = Models\Domain_Value::where('domain', 'BANDAGES')->orderBy('id')->get();    
  $domain['shadow_roll'] = Models\Domain_Value::where('domain', 'SHADOW_ROLL')->orderBy('id', 'desc')->get(); 
  $domain['neck_height'] = Models\Domain_Value::where('domain', 'NECK_HEIGHT')->get();
  $domain['run_style'] = Models\Domain_Value::where('domain', 'RUN_STYLE')->get();
  $domain['hood'] = Models\Domain_Value::where('domain', 'HOOD')->orderBy('id')->get();    
  $domain['person'] = Models\Person::orderBy('username', 'asc')->get();
  $domain['pos_abilities'] = Models\Ability::where('type', 'positive')
  ->orderBy('ability', 'asc')
  ->get();
  $domain['neg_abilities'] = Models\Ability::where('type', 'negative')
  ->orderBy('ability', 'asc')
  ->get(); 
  return $domain;
}

public function getRaceDomain($person_id = false){
  $domain = [];
  $horses = Models\Horse::select('id', 'call_name')->orderBy('call_name');
  if($person_id){
    $horses = $horses->where('owner', 'like', $person_id);   
  }
  $domain['my_horses'] = $horses->get()->toArray();   

  $domain['series'] =  Models\Domain_Value::where('domain', 'RACE_SERIES')->orderBy('value')->get();
  $domain['grades'] = Models\Domain_Value::where('domain', 'GRADE')->get();
  $domain['surfaces'] = Models\Domain_Value::where('domain', 'SURFACE')->get();

  $races = Models\Race::select('id', 'name', 'grade', 'surface', 'series', 'distance', 'ran_dt')
  ->orderBy('name')
  ->get()->toArray();

  foreach($races as $i=>$r){
   $races[$i]['series'] = Base::getSeriesValue($domain['series'], $r['series']);  
   $races[$i]['surface'] = ($r['surface'] == 41 ? 'Dirt' : 'Turf'); 
   $races[$i]['grade'] = Base::getGrade($domain['grades'], $r['grade']);  
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

public function getLineageDomain(){
  $domain = [];
  $sires = Models\Horse::select('id', 'call_name')->where('sex', 10)->orderBy('call_name');
  $dams = Models\Horse::select('id', 'call_name')->where('sex', 11)->orderBy('call_name');
  $horses = Models\Horse::select('call_name', 'id')->orderBy('call_name');
  $domain['sires'] = $sires->get()->toArray();
  $domain['dams'] = $dams->get()->toArray();
  $domain['horses'] = $horses->get()->toArray();
  return $domain;
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
  return view('guides.form',['domain' => Base::getHorseDomain()]);
}

public function guide_form_result(){
  $data = Base::trimWhiteSpace($_POST);
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
