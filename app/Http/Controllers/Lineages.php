<?php
namespace App\Http\Controllers;
use App\Models as Model;

class Lineages extends Controller{
/*
|--------------------------------------------------------------------------
| ------------------------------Table Controls
|--------------------------------------------------------------------------
*/
public function lineage_table($ancestors_of = false, $descendants_of = false){
  $lineages = Model\Horse::orderBy('generation')
  ->orderBy('call_name')
  ->whereNotNull('generation');

  if($ancestors_of != '0'){
    $horse = Model\Horse::select('id', 'sex')->where('id', $ancestors_of)->first();
    $lineages->whereIn('id', $horse->id);
  }

  $lineages = $lineages->get()->toArray();

  foreach($lineages as $i=>$record){
    $horse = Model\Horse::select('id', 'call_name', 'stall_path', 'owner')->where('id', $record['id'])->first();
    $sire = Model\Horse::select('call_name', 'stall_path')->where('id', $record['sire_id'])->first();
    $dam = Model\Horse::select('call_name', 'stall_path')->where('id', $record['dam_id'])->first();

    $lineages[$i]['horse_name'] = $horse['call_name'];
    $lineages[$i]['horse_link'] = $horse['stall_path'];

    $lineages[$i]['sire_name'] = $sire['call_name'];
    $lineages[$i]['sire_link'] = $sire['stall_path'];

    $lineages[$i]['dam_name'] = $dam['call_name'];
    $lineages[$i]['dam_link'] = $dam['stall_path'];
    $lineages[$i]['generation'] = ($record['generation'] ? $this->ordinal($record['generation']) : '' );

    $lineages[$i]['user_pl'] = 'false';

    if(Users::verifyOwner($horse->toArray())){
      $lineages[$i]['user_pl'] = 'true';
    }
  }

  return view('tables.lineages', [
    'lineage' => $lineages,
    'ancestors_of' => $ancestors_of,
    'descendants_of' => $descendants_of,
    'domain' => $this->lineagesTableDomain()
    ]);
}



public function lineage_table_validate(){
  $data = $this->trimWhiteSpace($_POST);

  return redirect()->route('lineage_table', [
    'ancestors_of' => $data['ancestors_of'],
    'descendants_of' => $data['descendants_of']
    ]);
}

public function lineagesTableDomain(){
  $domain = [];
  $domain['horses']  = Model\Horse::select('id', 'call_name')->orderBy('call_name')->get()->toArray();
  return $domain;
}

/*
|--------------------------------------------------------------------------
| ---------------------------Ancestor/Descendent
|--------------------------------------------------------------------------
*/

public static function getParents($horse_id){
  $record = Model\Horse::where('id', $horse_id)->first();
  $parents = [];


  $sire = Model\Horse::where('id', $record['sire_id'])->first();
  $dam = Model\Horse::where('id', $record['dam_id'])->first();


  $parents['sire_id'] = $record['sire_id'];
  $parents['sire_name'] = $sire['call_name'];
  $parents['sire_link'] = $sire['stall_path'];

  $parents['dam_id'] = $record['dam_id'];
  $parents['dam_name'] = $dam['call_name'];
  $parents['dam_link'] = $dam['stall_path'];


  $parents['generation'] = ($record ? Controller::ordinal($record['generation'])  :  '' );

  return $parents;
}

public static function return_ancestors($horse_id){
  $ids = [];
  Lineages::returnAncestorsHelper($horse_id, $ids);

  $horses = Model\Horse::select('id', 'stall_path', 'call_name', 'owner', 'breeding_status', 'grade', 'sex')
  ->whereIn('id', $ids)
  ->orderBy('call_name')
  ->get()->toArray();

  foreach($horses as $i=>$h){
    $horses[$i]['breeding_status'] = Model\Domain_Value::where('id', $h['breeding_status'])->first()['value'];

    $horses[$i]['grade'] = Model\Domain_Value::where('id', $h['grade'])->first()['value'];
    $horses[$i]['sex'] = Model\Domain_Value::where('id', $h['sex'])->first()['value'];
    $horses[$i]['owner'] = Model\Person::where('id', $h['owner'])->first()['username'];
    $horses[$i]['parents'] = Lineages::getParents($h['id']);
  }
  return $horses;
}

public static function returnAncestorsHelper($horse_id, &$ids = false){
  $sire = Model\Horse::select('sire_id')
  ->where('id', $horse_id)
  ->first();

  if($sire){
    array_push($ids, $sire['sire_id']);
    Lineages::returnAncestorsHelper($sire['sire_id'], $ids);
  }

  $dam = Model\Horse::select('dam_id')
  ->where('id', $horse_id)
  ->first();

  if($dam){
    array_push($ids, $dam['dam_id']);
    Lineages::returnAncestorsHelper($dam['dam_id'], $ids);
  }

}

public static function return_descendents($horse_id){
  $ids = [];
  Lineages::returnDescendentsHelper($horse_id, $ids);

  $horses = Model\Horse::select('id', 'stall_path', 'call_name', 'owner', 'breeding_status', 'grade', 'sex')
  ->whereIn('id', $ids)
  ->orderBy('call_name')
  ->get()->toArray();

  foreach($horses as $i=>$h){
    $horses[$i]['breeding_status'] = Model\Domain_Value::where('id', $h['breeding_status'])->first()['value'];
    $horses[$i]['grade'] = Model\Domain_Value::where('id', $h['grade'])->first()['value'];
    $horses[$i]['sex'] = Model\Domain_Value::where('id', $h['sex'])->first()['value'];
    $horses[$i]['owner'] = Model\Person::where('id', $h['owner'])->first()['username'];
    $horses[$i]['parents'] = Lineages::getParents($h['id']);
  }
  return $horses;
}

public static function returnDescendentsHelper($horse_id, &$ids = false){
  $offspring = Model\Horse::select('id')
  ->where('sire_id', $horse_id)
  ->orWhere('dam_id', $horse_id)
  ->get()->toArray();

  if($offspring){
    foreach($offspring as $o){

      array_push($ids, $o['id']);
      Lineages::returnDescendentsHelper($o['id'], $ids);

    }

  }


}


/*
|--------------------------------------------------------------------------
| ------------------------------Form Controls
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ------------------------------Utility Controls
|--------------------------------------------------------------------------
*/

public function getLineageRecord($sex = false, $horse_id = false){
  $dam = [];
  $sire = [];
  $horse = [];

  if($sex == "Mare" && $horse_id){
    $dam = Model\Horse::select('id', 'call_name')->where('id', $horse_id)->first();
  }

  if($sex == "Stallion" && $horse_id){
    $sire = Model\Horse::select('id', 'call_name')->where('id', $horse_id)->first();
  }

  if(is_numeric($sex) && $horse_id){
    $horse = Model\Horse::select('id', 'call_name')->where('id', $horse_id)->first();
    $record = Model\Horse::where('id', $horse['id'])->first();

    $sire = Model\Horse::select('id', 'call_name')->where('id', $record['sire_id'])->first();
    $dam = Model\Horse::select('id', 'call_name')->where('id', $record['dam_id'])->first();
  }

  $lineage['dam']['id'] = (empty($dam->id) ? '' : $dam->id);
  $lineage['dam']['call_name'] = (empty($dam->call_name) ? '' : $dam->call_name);
  $lineage['sire']['id'] = (empty($sire->id) ? '' : $sire->id);
  $lineage['sire']['call_name'] = (empty($sire->call_name) ? '' : $sire->call_name);
  $lineage['horse']['id'] = (empty($horse->id) ? '' : $horse->id);
  $lineage['horse']['call_name'] = (empty($horse->call_name) ? '' : $horse->call_name);
  $lineage['generation'] = (empty($record) ? '' : $record['generation']);

  return $lineage;
}


}