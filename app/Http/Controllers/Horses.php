<?php
namespace App\Http\Controllers;
use App\Models as Models;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Horses extends Base{

/*
|--------------------------------------------------------------------------
| Table Controls
|--------------------------------------------------------------------------
*/

public function horse_table($owner = false, $breeding_status = false, $sex = false, $grade = false){

  $horses = Horses::tableData($owner, $breeding_status, $sex, $grade);

  return view('tables.horses_display', [
    'horses' => $horses,
    'owner' => $owner,
    'breeding_status' => $breeding_status,
    'sex' => $sex,
    'grade' => $grade,
    'type' => false,
    'domain' => Base::getHorseDomain()
    ]);
}


public static function getMaxStat($horse_id){

  $stats = Models\Horse::select(
    'speed',
    'staying',
    'stamina',
    'breaking',
    'power',
    'feel',
    'tenacity',
    'courage',
    'response')
  ->where('id',$horse_id)
  ->first()->toArray();

  $max_stat = '';
  $max = 0;

  foreach($stats as $i=>$s){
    if($s > $max){
      $max = $s;
      $max_stat = $i;
    }
  }

  if($max == 0){
    return '';
  }

  return $max . ' ' . $max_stat;
}

public function horse_table_validate(){
  $data = Base::trimWhiteSpace($_POST);

  return redirect()->route('horse_table',
    [
    'owner' => $data['owner'],
    'breeding_status' => $data['breeding_status'],
    'sex' => $data['sex'],
    'grade' => $data['grade']
    ]
    );

}

/*
|--------------------------------------------------------------------------
| Form Controls
|--------------------------------------------------------------------------
*/

public function horse($horse_id = false, $form_type = false){
  $horse = Models\Horse::where('id', $horse_id)->first();
  $owner = '';
  $title = 'Create Horse';
  $validate = false;

  if($horse){
    $horse = $horse->toArray();
    if(!Users::verifyOwner($horse)){
      abort(401, 'You do not own this horse.');
    }

    $title = 'Edit '. $horse['call_name'];
  } else {
    $owner = Users::getPerson();
    if($owner['id'] == '%'){
      $owner = false;
    }
  }

  return view('forms.horse_page', [
   'domain' => Base::getHorseDomain(),
   'horse' => $horse,
   'owner' => $owner,
   'title' => $title,
   'validate' => $validate,
   'form_type' => $form_type
   ]);
}

public function horse_validate(){
  $data = Base::trimWhiteSpace($_POST);

  if(!Users::verifyOwner($data)){
    abort(401, 'You do not own this horse.');
  }
  $horse = Horses::createHorse($data);
  return redirect()->route('stall', ['horse_id' => $horse->id]);
}


/*
|--------------------------------------------------------------------------
| Stall Controls
|--------------------------------------------------------------------------
*/

public function stall($horse_id){
  $chartData = [];
  $tableData = [];
  $horse = [];

  $horse = Horses::generateStall(Models\Horse::where('id', $horse_id)->first());

  $abilities = Models\Ability::where('id', $horse['pos_ability_1'])
  ->orWhere('id', $horse['pos_ability_2'])
  ->orWhere('id', $horse['neg_ability_1'])
  ->orderBy('type', 'desc')->get();

  if($abilities){
    $horse['abilities'] = $abilities->toArray();
  } else {
    $horse['abilities'] = false;
  }

  $parents = Lineages::getParents($horse_id);

  if(array_filter($parents)){
    $horse['parents'] = $parents;
  } else {
    $horse['parents'] = false;
  }

  $tableData['ancestors'] = Lineages::return_ancestors($horse_id);
  $tableData['descendents'] = Lineages::return_descendents($horse_id);
  $tableData['race_records'] = Horses::getRaceRecords($horse_id);

  $chartData['placings'] = $placingsData = Race_Entries::getPlacingsData(Race_Entries::getEntryRecords([$horse]));

  return view('pages.stall', [
    'chartData' => $chartData,
    'tableData' => $tableData,
    'horse' => $horse
    ]);
}

/*
|--------------------------------------------------------------------------
| Create Controls
|--------------------------------------------------------------------------
*/

public function generateStall($horse){
  if(!$horse){
    return false;
  }

  $data = [];


  $horse = $horse->toArray();

  foreach($horse as $i=>$h){
    $data[$i] = $h;
  }

  $data['sex'] = Models\Domain_Value::where('id', $horse['sex'])->first()['value'];

  $data['breeding_status'] = Models\Domain_Value::where('id', $horse['breeding_status'])->first()['value'];
  $data['grade'] = Models\Domain_Value::where('id', $horse['grade'])->first()['description'];

  $data['owner'] = Models\Person::where('id', $horse['owner'])->first()->toArray();
  $data['breeder'] = Models\Person::select('username')->where('id', $horse['breeder'])->first()['username'];

  $hexer = Models\Person::where('id', $horse['hexer'])->first();

  if($hexer){
    $data['hexer'] = $hexer->toArray();
  } else {
    $data['hexer'] = '';
  }

  $data['surface_dirt'] = Models\Domain_Value::where('id', $horse['surface_dirt'])->first()['value'];
  $data['surface_turf'] = Models\Domain_Value::where('id', $horse['surface_turf'])->first()['value'];

  $data['leg_type'] = Models\Domain_Value::where('id', $horse['leg_type'])->first()->toArray();
  $data['neck_height'] = Models\Domain_Value::where('id', $horse['neck_height'])->first()['value'];
  $data['run_style'] = Models\Domain_Value::where('id', $horse['run_style'])->first()['value'];
  $data['bandages'] = Models\Domain_Value::where('id', $horse['bandages'])->first()['value'];
  $data['hood'] = Models\Domain_Value::where('id', $horse['hood'])->first()['value'];
  $data['shadow_roll']  = Models\Domain_Value::where('id', $horse['shadow_roll'])->first()['value'];


  return $data;
}

public function getOffspring($horse_id, $sex){
  $offspring = [];

  if($sex == 10){
    $offspring = Models\Horse::where('sire_id', $horse_id)->get();

    foreach($offspring as $i=>$o){
      $foal = Models\Horse::where('id', $o['id'])->first();
      $offspring[$i]['id'] = $foal['id'];
      $offspring[$i]['horse_name'] = $foal['call_name'];
      $offspring[$i]['horse_link']= $foal['stall_path'];

      $dam = Models\Horse::where('id', $o['dam_id'])->first();
      $offspring[$i]['dam_name'] = $dam['call_name'];
      $offspring[$i]['dam_link'] = $dam['stall_path'];
    }
  } else if($sex == 11){
    $offspring = Models\Horse::where('dam_id', $horse_id)->get();

    foreach($offspring as $i=>$o){
      $foal = Models\Horse::where('id', $o['id'])->first();
      $offspring[$i]['id'] = $foal['id'];
      $offspring[$i]['horse_name'] = $foal['call_name'];
      $offspring[$i]['horse_link']= $foal['stall_path'];

      $sire = Models\Horse::where('id', $o['sire_id'])->first();
      $offspring[$i]['sire_name'] = $sire['call_name'];
      $offspring[$i]['sire_link'] = $sire['stall_path'];
    }
  }

  return $offspring;
}


public static function getRaceRecords($horse_id){
  $horse = Models\Horse::find($horse_id);
  $permissions = 'false';
  if(Users::verifyOwner($horse)){
    $permissions = 'true';
  }
  $records = [];

  $entries = Models\Race_Entry::where('horse_id', $horse_id)
  ->orderBy('placing')
  ->get();

  $races =  Models\Race::get()->toArray();
  $series =  Models\Domain_Value::where('domain', 'RACE_SERIES')->orderBy('value')->get();
  $grades =  Models\Domain_Value::where('domain', 'GRADE')->orderBy('value')->get();

  if($entries){
    $entries = $entries->toArray();

    foreach($entries as $i=>$p){
      $race = Base::getRace($races, $p['race_id']);

      $race['series'] = Base::getSeriesValue($series, $race['series']);

      $race['surface'] = ($race['surface'] == 41 ? 'Dirt' : 'Turf');
      $race['grade'] = Base::getGrade($grades, $race['grade']);

      $race['placing'] =  $p['placing'];
      $race['isNotableWin'] = $p['isNotableWin'];
      $race['isTrackRecord'] = $p['isTrackRecord'];
      $race['time'] = $p['time'];
      $race['entry_id'] = $p['id'];
      $race['user_pl'] = $permissions;

      $records[$i] = $race;
    }
  }

  return $records;
}


public function createHorse($data){
  $horse = Models\Horse::firstOrNew(['id' => $data['id']]);

  $horse->call_name = (!empty($data['call_name']) ? $data['call_name'] : '');
  $horse->registered_name = (!empty($data['registered_name']) ? $data['registered_name'] : '');

  $horse->sex = (!empty($data['sex']) ? $data['sex'] : '44');
  $horse->color = (!empty($data['color']) ? $data['color'] : '');
  $horse->phenotype = (!empty($data['phenotype']) ? $data['phenotype'] : '');
  $horse->breeding_status = (!empty($data['breeding_status']) ? $data['breeding_status'] : '44');

  $horse->grade = (!empty($data['grade']) ? $data['grade'] : '44');

  $horse->owner = (!empty($data['owner']) ? $data['owner'] : '44');
  $horse->breeder = (!empty($data['breeder']) ? $data['breeder'] : '44');
  $horse->hexer = (!empty($data['hexer']) ? $data['hexer'] : '44');

  $horse->pos_ability_1 = (!empty($data['pos_ability_1']) ? $data['pos_ability_1'] : '44');
  $horse->pos_ability_2 = (!empty($data['pos_ability_2']) ? $data['pos_ability_2'] : '44');
  $horse->neg_ability_1 = (!empty($data['neg_ability_1']) ? $data['neg_ability_1'] : '44');

  $horse->distance_min = (!empty($data['distance_min']) ? $data['distance_min'] : '');
  $horse->distance_max = (!empty($data['distance_max']) ? $data['distance_max'] : '');

  $horse->surface_dirt = (!empty($data['surface_dirt']) ? $data['surface_dirt'] : '44');
  $horse->surface_turf = (!empty($data['surface_turf']) ? $data['surface_turf'] : '44');

  $horse->speed = (!empty($data['speed']) ? $data['speed'] : '');
  $horse->staying = (!empty($data['staying']) ? $data['staying'] : '');
  $horse->stamina = (!empty($data['stamina']) ? $data['stamina'] : '');
  $horse->breaking = (!empty($data['breaking']) ? $data['breaking'] : '');
  $horse->power = (!empty($data['power']) ? $data['power'] : '');
  $horse->feel = (!empty($data['feel']) ? $data['feel'] : '');
  $horse->fierce = (!empty($data['fierce']) ? $data['fierce'] : '');
  $horse->tenacity = (!empty($data['tenacity']) ? $data['tenacity'] : '');
  $horse->courage = (!empty($data['courage']) ? $data['courage'] : '');
  $horse->response = (!empty($data['response']) ? $data['response'] : '');

  $horse->leg_type = (!empty($data['leg_type']) ? $data['leg_type'] : '44');
  $horse->neck_height = (!empty($data['neck_height']) ? $data['neck_height'] : '44');
  $horse->run_style = (!empty($data['run_style']) ? $data['run_style'] : '44');
  $horse->bandages = (!empty($data['bandages']) ? $data['bandages'] : '44');
  $horse->hood = (!empty($data['hood']) ? $data['hood'] : '44');
  $horse->shadow_roll = (!empty($data['shadow_roll']) ? $data['shadow_roll'] : '44');
  $horse->notes = (!empty($data['notes']) ? $data['notes'] : '');

  $horse->stall_img = (!empty($data['stall_img']) ? $data['stall_img'] : '');
  $horse->racing_img = (!empty($data['racing_img']) ? $data['racing_img'] : '');

  $horse->save();

  if($data['stall_path'] != ''){
   $horse->stall_path = $data['stall_path'];
 }

 $horse->save();

 return $horse;
}

/*
|--------------------------------------------------------------------------
| Utitlity Controls
|--------------------------------------------------------------------------
*/

public function remove_horse($horse_id){
  $horse = Models\Horse::find($horse_id);
  if(!Users::verifyOwner($horse)){
    abort(401, 'You do not own this horse.');
  }
  $horse = Models\Horse::find($horse_id);
  $entries = Models\Race_Entry::where('horse_id', $horse_id)->first();

  if(empty($_POST)){
    return view('pages.remove_horse', [
      'horse' => $horse,
      'lineages' => $lineages,
      'entries' => $entries
      ]);
  } else {
    $horse->delete();
    return redirect()->route('horse_table');
  }
}


public static function tableData($owner = false, $breeding_status = false, $sex = false, $grade = false){
  $horses = Models\Horse::orderBy('id', 'desc');

  if($owner != "false" && $owner && $owner != '0'){
    $horses->where('owner', $owner);
  }

  if($breeding_status != "false" && $breeding_status && $breeding_status != '0'){
    $horses->where('breeding_status', $breeding_status);
  }

  if($sex != "false" && $sex && $sex != '0'){
    $horses->where('sex', $sex);
  }

  if($grade != "false" && $grade && $grade != '0'){
    $horses->where('grade', $grade);
  }


  if($horses){
    $horses = $horses->get()->toArray();

    foreach($horses as $i=>$h){
      $horses[$i]['breeding_status'] = Models\Domain_Value::where('id', $h['breeding_status'])->first()['value'];

      $horses[$i]['pos_ability_1'] = Models\Ability::where('id', $h['pos_ability_1'])->first()['ability'];
      $horses[$i]['pos_ability_2'] = Models\Ability::where('id', $h['pos_ability_2'])->first()['ability'];
      $horses[$i]['neg_ability_1'] = Models\Ability::where('id', $h['neg_ability_1'])->first()['ability'];

      $horses[$i]['surface_dirt'] = Models\Domain_Value::where('id', $h['surface_dirt'])->first()['value'];
      $horses[$i]['surface_turf'] = Models\Domain_Value::where('id', $h['surface_turf'])->first()['value'];

      $horses[$i]['grade'] = Models\Domain_Value::where('id', $h['grade'])->first()['value'];
      $horses[$i]['sex'] = Models\Domain_Value::where('id', $h['sex'])->first()['value'];
      $horses[$i]['owner'] = Models\Person::where('id', $h['owner'])->first()['username'];

      $horses[$i]['max_stat'] = Horses::getMaxStat($h['id']);
      $horses[$i]['user_pl'] = 'false';

      if(Users::verifyOwner($h)){
        $horses[$i]['user_pl'] = 'true';
      }

      foreach($horses[$i] as $j=>$v){
        if($v == 'Unknown'){
          $horses[$i][$j] = '';
        }
      }
    }
  }

  return $horses;
}

}
