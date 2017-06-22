<?php

namespace App\Http\Controllers;
use App\Models as Model;

use Carbon\Carbon;


class Race_Entries extends Controller{

/*
|--------------------------------------------------------------------------
|------------------------------ Table Controls
|--------------------------------------------------------------------------
*/

public function entry_table($race = false, $placing = false, $horse = false, $owner = false){
  $entries = Race_Entries::tableData($race, $placing, $horse, $owner);

  return view('tables.entries', [
    'entries' => $entries,
    'race' => $race,
    'placing' => $placing,
    'horse' => $horse,
    'owner' => $owner,
    'domain' => Race_Entries::entriesTableDomain()
    ]);
}

public function entry_table_validate(){
  $data = $this->trimWhiteSpace($_POST);

  return redirect()->route('entry_table', [
    'race' => $data['race'],
    'placing' => $data['placing'],
    'horse' => $data['horse'],
    'owner' => $data['owner']
    ]);
}

public function entriesTableDomain(){
  $domain = [];
  $domain['person'] = Model\Person::select('id', 'username')->orderBy('username', 'asc')->get();
  $races = Model\Race::orderBy('name')->get()->toArray();
  $series = Model\Domain_Value::where('domain', 'RACE_SERIES')->get();
  $grades = Model\Domain_Value::where('domain', 'GRADE')->get();

  foreach($races as $i=>$r){
    $races[$i]['series'] = $this->getSeriesValue($series, $r['series']);
    $races[$i]['surface'] = ($r['surface'] == 41 ? 'Dirt' : 'Turf');
    $races[$i]['grade'] = $this->getGrade($grades, $r['grade']);
  }

  $domain['horses']  = Model\Horse::select('id', 'call_name')->orderBy('call_name')->get()->toArray();
  $domain['races'] = $races;
  return $domain;
}

/*
|--------------------------------------------------------------------------
| ------------------------------Form Controls
|--------------------------------------------------------------------------
*/

public function entry($horse_id = false, $entry_id = false, $validate = false){
  $entry  = Model\Race_Entry::where('id', $entry_id)->first();

  if($entry){
    $horse = Model\Horse::where('id', $horse_id)->first();

    if(!Users::verifyOwner($horse)){
      abort(401, 'You do not own this horse.');
    }
  } else {
    $entry['id'] = '';
    $entry['race_id'] = '';
    $entry['horse_id'] = '';
    $entry['placing'] = '';
    $entry['isNotableWin'] = '';
    $entry['isTrackRecord'] = '';
    $entry['time'] = '';
    $entry['horse'] = '';

    if($horse_id){
      $entry['horse_id'] = $horse_id;
    }
  }

  return view('forms.entry_page', [
    'options' => $this->getRaceDomain(Users::getPerson()['id']),
    'entry' => $entry,
    'validate' => $validate
    ]);
}

public function entry_validate(){
  $data = $this->trimWhiteSpace($_POST);
  $entry = Race_Entries::createEntry($data);
  return Race_Entries::entry(false, false, true);
}

/*
|--------------------------------------------------------------------------
| ------------------------------Utility Controls
|--------------------------------------------------------------------------
*/

public function createEntry($data){
  $entry = Model\Race_Entry::firstOrNew([
    'horse_id' => $data['horse_id'],
    'race_id' => $data['race_id']
    ]);

  $entry->horse_id = (!empty($data['horse_id']) ? $data['horse_id'] : '');
  $entry->race_id = (!empty($data['race_id']) ? $data['race_id'] : '');
  $entry->placing = (!empty($data['placing']) ? $data['placing'] : '0');
  $entry->isNotableWin = (!empty($data['isNotableWin']) ? $data['isNotableWin'] : 'NO');
  $entry->isTrackRecord = (!empty($data['isTrackRecord']) ? $data['isTrackRecord'] : 'NO');
  $entry->time = (!empty($data['time']) ? $data['time'] : '');
  $entry->save();

  return $entry;
}


public function remove_entry($entry_id){
  $entry = Model\Race_Entry::find($entry_id);

  $horse = Model\Horse::find($entry->horse_id);
  if(!Users::verifyOwner($horse)){
    abort(401, 'You do not own this horse.');
  }

  if(empty($_POST)){
    $entry['horse'] = Model\Horse::select('call_name')->where('id', $entry->horse_id)->first();
    $entry['race'] = Model\Race::select('name', 'series')->where('id', $entry->race_id)->first();

    return view('pages.remove_entry', [
      'entry' => $entry
      ]);
  } else {
    $entry->delete();
    return redirect()->route('entry_table');
  }
}

public function tableData($race = false, $placing = false, $horse = false, $owner = false){
  $entries = Model\Race_Entry::orderBy('placing');
  $domain = Race_Entries::entriesTableDomain();

  if($owner && $owner != '0'){
    $horses = array_values(Model\Horse::select('id')
      ->where('owner', $owner)
      ->get()->toArray());
    $entries->whereIn('horse_id', $horses);
  }

  if($horse && $horse != '0'){
    $entries->where('horse_id', $horse);
  }

  if($placing && $placing != '0'){
    $entries->where('placing', $placing);
  }

  if($race && $race != '0'){
    $entries->where('race_id', $race);
  }

  if($entries){

    $entries = $entries->get();

    foreach($entries as $i=>$e){
      $ordinal_place =  $e['placing'];

      if($ordinal_place == 0){
        $ordinal_place = 'TBA';
      }

      $entries[$i]['placing'] = $ordinal_place;

      $horse_tmp = Model\Horse::select('call_name', 'id','stall_path','owner')->where('id', $e['horse_id'])->first();

      $entries[$i]['horse_name'] = $horse_tmp['call_name'];
      $entries[$i]['stall_path'] = $horse_tmp->stall_path;

      $race_tmp = $this->getRace($domain['races'], $e['race_id']);

      $entries[$i]['race_name'] = $race_tmp['name'];
      $entries[$i]['race_distance'] = $race_tmp['distance'];
      $entries[$i]['race_randt'] = $race_tmp['ran_dt'];
      $entries[$i]['url'] = $race_tmp['url'];

      $entries[$i]['race_grade'] = $race_tmp['grade'];
      $entries[$i]['race_surface'] = $race_tmp['surface'];
      $entries[$i]['race_series'] = $race_tmp['series'];

      $entries[$i]['user_pl'] = 'false';

      if(Users::verifyOwner($horse_tmp->toArray())){
        $entries[$i]['user_pl'] = 'true';
      }
    }
  }

  return $entries;
}

public static function getPlacingsData($placings){
  $results = [];

  for($i = 1; $i < 15; $i++){
    $results[$i] = [$i, 0];
  }

  $results[0] = ['TBA', 0];

  foreach($placings as $p){
    $place = $p['placing'];
    foreach($results as $i=>$r){
      $curr_place = $r[0];
      if($place == $curr_place){
        $results[$i][1] += 1;
      }
    }
  }

  foreach($results as $i=>$r){
    if($results[$i][0] != 'TBA'){
      $results[$i][0] = Controller::ordinal($results[$i][0]);
    }

    if($results[$i][0] == 0){
      unset($results[$i]);
    }
  }

  return json_encode(array_values($results));
}

public static function getEntryRecords($horses){
  $results = [];
  $records = [];
  foreach($horses as $h){
    $records = $entries = Model\Race_Entry::where('horse_id', $h['id'])
    ->orderBy('placing')
    ->get();

    if($records){
      $records = $records->toArray();
      foreach($records as $r){
        array_push($results, $r);
      }
    }
    $records = [];
  }

  return $results;
}


}
