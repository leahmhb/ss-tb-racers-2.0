<?php

namespace App\Http\Controllers;
use App\Models as Model;

use Carbon\Carbon;

use Illuminate\Foundation\Bus\DispatchesJobs;


class Races extends Controller{

/*
|--------------------------------------------------------------------------
| ------------------------------Table Controls
|--------------------------------------------------------------------------
*/

public function race_table($grade = false, $surface = false, $series = false, $distance = false, $year = false){
  $races = Races::tableData($grade, $surface, $series, $distance, $year);

  return view('tables.races', [
    'races' => $races,
    'grade' => $grade,
    'surface' => $surface,
    'series' => $series,
    'distance' => $distance,
    'year' => $year,
    'domain' => Races::racesTableDomain()
    ]);
}

public function race_table_validate(){
  $data = $this->trimWhiteSpace($_POST);

  return redirect()->route('race_table',     [
    'grade' => $data['grade'],
    'surface' => $data['surface'],
    'series' => $data['series'],
    'distance' => $data['distance'],
    'year' => $data['year']
    ]);
}


public function racesTableDomain(){
  $domain = [];
  $domain['series'] = Model\Domain_Value::where('domain', 'RACE_SERIES')->get()->toArray();
  $domain['surface'] = Model\Domain_Value::where('domain', 'SURFACE')->get()->toArray();
  $domain['grade'] = Model\Domain_Value::where('domain', 'GRADE')->get()->toArray();
  return $domain;
}

/*
|--------------------------------------------------------------------------
| ------------------------------Form Controls
|--------------------------------------------------------------------------
*/

public function race($race_id = false, $validate = false){
  $race = Model\Race::where('id', $race_id)->first();
  $title = 'Create Race';

  if($race){
    $title = 'Edit '. $race->name;
    if(!Users::verifyJockeyClub()){
      abort(401, 'You do not have Jockey Club permissions.');
    }
  }

  return view('forms.race_page', [
    'race' => $race,
    'options' => $this->getRaceDomain('%'),
    'title' => $title,
    'validate' => $validate
    ]);
}

public function race_validate(){
  $data = $this->trimWhiteSpace($_POST);
  $race = Races::createRace($data);

  if($data['id'] != 0){
    return redirect()->route('race_table');
  }

  return Races::race(false, true);
}

/*
|--------------------------------------------------------------------------
| ------------------------------Utility Controls
|--------------------------------------------------------------------------
*/


public function createRace($data){
  $race = Model\Race::firstOrNew([
    'id' => $data['id']
    ]);

  if(!$data['ran_dt']){
    $data['ran_dt'] = '1000-01-01';
  }

  $date = Carbon::createFromFormat('Y-m-d', $data['ran_dt'])->startOfDay();

  $race->series = (!empty($data['series']) ? $data['series'] : '');
  $race->name = (!empty($data['name']) ? $data['name'] : '');
  $race->distance = (!empty($data['distance']) ? $data['distance'] : '');
  $race->grade = (!empty($data['grade']) ? $data['grade'] : '');
  $race->surface = (!empty($data['surface']) ? $data['surface'] : '');
  $race->url = (!empty($data['url']) ? $data['url'] : '');
  $race->weather = (!empty($data['weather']) ? $data['weather'] : '');
  $race->course = (!empty($data['course']) ? $data['course'] : '');
  $race->final_time = (!empty($data['final_time']) ? $data['final_time'] : '');
  $race->ran_dt = $date;

  $race->save();

  return $race;
}


public function remove_race($race_id){
  $race = Model\Race::find($race_id);

  if(empty($_POST)){
    $entries = Model\Race_Entry::where('race_id',$race_id)->first();
    return view('pages.remove_race', [
      'race' => $race,
      'entries' => $entries
      ]);
  } else {
    $race->delete();
    $entries = Model\Race_Entry::where('race_id', $race_id);
    $entries->delete();
    return redirect()->route('race_table');
  }
}

public function tableData($grade = false, $surface = false, $series = false, $distance = false, $year = false){
  $races = Model\Race::orderBy('name', 'asc');
  $domain = Races::racesTableDomain();


  if($grade && $grade != 0){
    $races->where('grade', $grade);
  }

  if($surface && $surface != 0){
    $races->where('surface', $surface);
  }

  if($series && $series != 0){
    $races->where('series', $series);
  }

  if($distance && $distance != 0){
    $races->where('distance', $distance);
  }

  if($year && $year != 0){
    $races->where('ran_dt', 'like', $year . '%');
  }

  if($races){
    $races = $races->get();
    foreach($races as $i=>$r){
      $races[$i]['grade'] = $this->getGrade($domain['grade'], $r['grade']);
      $races[$i]['surface'] = ($r['surface'] == 41 ? 'Dirt' : 'Turf');

      if($r['series'] != 44){
        $races[$i]['series'] = $this->getSeriesValue($domain['series'], $r['series']);
      } else {
        $races[$i]['series'] = '';
      }

      $races[$i]['user_pl'] = 'false';

      if(Users::verifyJockeyClub()){
        $races[$i]['user_pl'] = 'true';
      }
    }
  }

  return $races;
}






}
