<?php
namespace App\Http\Controllers;
use App\Models as Models;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Lineages extends Base{
/*
|--------------------------------------------------------------------------
| ------------------------------Table Controls
|--------------------------------------------------------------------------
*/
public function lineage_table($ancestors_of = false, $descendants_of = false){
  $lineages = Models\Horse::orderBy('generation')
  ->orderBy('call_name')
  ->whereNotNull('generation');

  if($ancestors_of != '0'){
    $horse = Models\Horse::select('id', 'sex')->where('id', $ancestors_of)->first();
    $lineages->whereIn('id', $horse->id);
  }

  $lineages = $lineages->get()->toArray();

  foreach($lineages as $i=>$record){
    $horse = Models\Horse::select('id', 'call_name', 'stall_path', 'owner')->where('id', $record['id'])->first();
    $sire = Models\Horse::select('call_name', 'stall_path')->where('id', $record['sire_id'])->first();
    $dam = Models\Horse::select('call_name', 'stall_path')->where('id', $record['dam_id'])->first();

    $lineages[$i]['horse_name'] = $horse['call_name'];
    $lineages[$i]['horse_link'] = $horse['stall_path'];

    $lineages[$i]['sire_name'] = $sire['call_name'];
    $lineages[$i]['sire_link'] = $sire['stall_path'];

    $lineages[$i]['dam_name'] = $dam['call_name'];
    $lineages[$i]['dam_link'] = $dam['stall_path'];
    $lineages[$i]['generation'] = ($record['generation'] ? Base::ordinal($record['generation']) : '' );

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
  $data = Base::trimWhiteSpace($_POST);

  return redirect()->route('lineage_table', [
    'ancestors_of' => $data['ancestors_of'],
    'descendants_of' => $data['descendants_of']
    ]);
}

public function lineagesTableDomain(){
  $domain = [];
  $domain['horses']  = Models\Horse::select('id', 'call_name')->orderBy('call_name')->get()->toArray();
  return $domain;
}

/*
|--------------------------------------------------------------------------
| ---------------------------Ancestor/Descendent
|--------------------------------------------------------------------------
*/

public static function getParents($horse_id){
  $record = Models\Horse::where('id', $horse_id)->first();
  $parents = [];


  $sire = Models\Horse::where('id', $record['sire_id'])->first();
  $dam = Models\Horse::where('id', $record['dam_id'])->first();


  $parents['sire_id'] = $record['sire_id'];
  $parents['sire_name'] = $sire['call_name'];
  $parents['sire_link'] = $sire['stall_path'];

  $parents['dam_id'] = $record['dam_id'];
  $parents['dam_name'] = $dam['call_name'];
  $parents['dam_link'] = $dam['stall_path'];


  $parents['generation'] = ($record ? Base::ordinal($record['generation'])  :  '' );

  return $parents;
}

public static function return_ancestors($horse_id){
  $ids = [];
  Lineages::returnAncestorsHelper($horse_id, $ids);

  $horses = Models\Horse::select('id', 'stall_path', 'call_name', 'owner', 'breeding_status', 'grade', 'sex')
  ->whereIn('id', $ids)
  ->orderBy('call_name')
  ->get()->toArray();

  foreach($horses as $i=>$h){
    $horses[$i]['breeding_status'] = Models\Domain_Value::where('id', $h['breeding_status'])->first()['value'];

    $horses[$i]['grade'] = Models\Domain_Value::where('id', $h['grade'])->first()['value'];
    $horses[$i]['sex'] = Models\Domain_Value::where('id', $h['sex'])->first()['value'];
    $horses[$i]['owner'] = Models\Person::where('id', $h['owner'])->first()['username'];
    $horses[$i]['parents'] = Lineages::getParents($h['id']);
  }
  return $horses;
}

public static function returnAncestorsHelper($horse_id, &$ids = false){
  $sire = Models\Horse::select('sire_id')
  ->where('id', $horse_id)
  ->first();

  if($sire){
    array_push($ids, $sire['sire_id']);
    Lineages::returnAncestorsHelper($sire['sire_id'], $ids);
  }

  $dam = Models\Horse::select('dam_id')
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

  $horses = Models\Horse::select('id', 'stall_path', 'call_name', 'owner', 'breeding_status', 'grade', 'sex')
  ->whereIn('id', $ids)
  ->orderBy('call_name')
  ->get()->toArray();

  foreach($horses as $i=>$h){
    $horses[$i]['breeding_status'] = Models\Domain_Value::where('id', $h['breeding_status'])->first()['value'];
    $horses[$i]['grade'] = Models\Domain_Value::where('id', $h['grade'])->first()['value'];
    $horses[$i]['sex'] = Models\Domain_Value::where('id', $h['sex'])->first()['value'];
    $horses[$i]['owner'] = Models\Person::where('id', $h['owner'])->first()['username'];
    $horses[$i]['parents'] = Lineages::getParents($h['id']);
  }
  return $horses;
}

public static function returnDescendentsHelper($horse_id, &$ids = false){
  $offspring = Models\Horse::select('id')
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

public function lineage($sex = false, $horse_id = false, $validate = false){
  $horse = Models\Horse::where('id', $horse_id)->first();

  if($horse){
    if(!Users::verifyOwner($horse)){
      abort(401, 'You do not own this horse.');
    }
  }

  $lineage = $this->getLineageRecord($sex, $horse_id);
  $options = Base::getLineageDomain();

  return view('forms.lineage_page', [
    'options' => $options,
    'lineage' => $lineage,
    'validate' => $validate
    ]);
}

public function lineage_validate($sex = false, $horse_id = false){
  $data = Base::trimWhiteSpace($_POST);
  $lineage = $this->createLineage($data);
  return $this->lineage(false, false, true);
}

/*
|--------------------------------------------------------------------------
| ------------------------------Utility Controls
|--------------------------------------------------------------------------
*/

public function createLineage($data){
  $lineage = Models\Horse::firstOrNew(['id' => $data['id']]);
  $lineage->horse_id = $data['id'];
  $lineage->sire_id = $data['sire_id'];
  $lineage->dam_id = $data['dam_id'];
  $lineage->generation = (!empty($data['generation']) ? $data['generation'] : '');
  $lineage->save();
  return $lineage;
}

public function remove_lineage($horse_id){
  $lineage = Models\Horse::where('id', $horse_id)->first();
  $lineages = Models\Horse::where('sire_id', $horse_id)->orWhere('dam_id', $horse_id)->first();

  $horse = Models\Horse::find($horse_id);
  if(!Users::verifyOwner($horse)){
    abort(401, 'You do not own this horse.');
  }

  if(empty($_POST)){
    $horse = Models\Horse::select('id','call_name')->where('id', $lineage->horse_id)->first();
    return view('pages.remove_lineage', [
      'lineages' => $lineages,
      'horse' => $horse
      ]);
  } else {
    //$lineage->delete();
    return redirect()->route('lineage_table');
  }
}


public function getLineageRecord($sex = false, $horse_id = false){
  $dam = [];
  $sire = [];
  $horse = [];

  if($sex == "Mare" && $horse_id){
    $dam = Models\Horse::select('id', 'call_name')->where('id', $horse_id)->first();
  }

  if($sex == "Stallion" && $horse_id){
    $sire = Models\Horse::select('id', 'call_name')->where('id', $horse_id)->first();
  }

  if(is_numeric($sex) && $horse_id){
    $horse = Models\Horse::select('id', 'call_name')->where('id', $horse_id)->first();
    $record = Models\Horse::where('id', $horse['id'])->first();

    $sire = Models\Horse::select('id', 'call_name')->where('id', $record['sire_id'])->first();
    $dam = Models\Horse::select('id', 'call_name')->where('id', $record['dam_id'])->first();
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