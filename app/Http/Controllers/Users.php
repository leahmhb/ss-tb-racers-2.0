<?php
namespace App\Http\Controllers;

use App\Models as Models;
use Illuminate\Routing\Controller as BaseController;
use Auth;

use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Users extends Base{

/*
|--------------------------------------------------------------------------
| ------------------------------Table Controls
|--------------------------------------------------------------------------
*/

public static function user_table_data(){
  $users = Models\User::select('id', 'name')->orderBy('name')->get()->toArray();
  return $users;
}

/*
|--------------------------------------------------------------------------
| ------------------------------Form Controls
|--------------------------------------------------------------------------
*/

public function user($user_id, $validate = false){
  $user = Models\User::where('id', $user_id)->first();
  $persons = Models\Person::select('id','username')->orderBy('username')->get();
  $title = 'Edit ' . $user->name;
  $person_id = Models\Person::where('user_id', $user->id)->first()['id'];

  return view('forms.user_page', [
    'user' => $user,
    'persons' => $persons,
    'person_id' => $person_id,
    'title' => $title,
    'validate' => $validate
    ]);
}

public function user_validate(){
 $data = Base::trimWhiteSpace($_POST);
 $user = Users::editUser($data);
 return redirect()->route('user', ['validate' => true]);
}

/*
|--------------------------------------------------------------------------
| ------------------------------Protected Check Controls
|--------------------------------------------------------------------------
*/

protected static function checkAdmin($user){
  if($user){
    return ($user->isAdmin == 1 ? true : false);
  }
  else {
    return false;
  }
}

protected static function checkJockeyClub($user){
  if(Users::checkAdmin($user)){
    /* Bypass further authentication */
    return true;
  }


  if($user){
    return ($user->isJockeyClub == 1 ? true : false);
  }
  else {
    return false;
  }
}


protected static function checkOwner($user, $owner_id = false, $horse_id = false){
  if(Users::checkAdmin($user)){
    /* Bypass further authentication */
    return true;
  }

  if($user){
    if(!$horse_id){
      return ($user->isOwner == 1 ? true : false);
    }

    if($horse_id && $owner_id){
     /* Check if User is an Owner of THIS horse. Field is MANUALLY set. */
     $id = $user->id;
     $person = Models\Person::where('user_id', $id)->first();
     /* Owner is editing their existing horse. */
     $horse = Models\Horse::select('owner')->where('id', $horse_id)->where('owner', $owner_id)->first();
     /* Check match between logged in User and Horse's owner */
     return $person['id'] == $horse['owner'];
   }
 }

 return false;
}

/*
|--------------------------------------------------------------------------
| ------------------------------Public Verify Controls
|--------------------------------------------------------------------------
*/

public static function verifyAdmin(){
  $user = Auth::user();
  if(Users::checkAdmin($user)){
    /* Bypass further authentication */
    return true;
  }
  return false;
}

public static function verifyJockeyClub(){
  $user = Auth::user();
  if(Users::checkAdmin($user)){
    /* Bypass further authentication */
    return true;
  }
  return Users::checkJockeyClub($user);
}

public static function verifyOwner($horse){
  $user = Auth::user();
  if($horse['id'] == ''){
    $horse['id'] == false;
  }
  return Users::checkOwner($user, $horse['owner'], $horse['id']);
}

/*
|--------------------------------------------------------------------------
| ------------------------------Utility Functions
|--------------------------------------------------------------------------
*/

public static function getPermissionLevel(){
  $user = Auth::user();
  if(Users::checkAdmin($user)){
    return 'admin';
  } else if (Users::checkJockeyClub($user)){
    return 'jockey_club';
  } else if (Users::checkOwner($user, false, false)){
    return 'owner';
  }
}

public function editUser($data){

 $user = Models\User::where(['id' => $data['id']])->first();

 $user->name = (!empty($data['name']) ? $data['name'] : '');
 $user->isAdmin = (!empty($data['isAdmin']) ? $data['isAdmin'] : '');
 $user->isJockeyClub = (!empty($data['isJockeyClub']) ? $data['isJockeyClub'] : '');
 $user->isOwner = (!empty($data['isOwner']) ? $data['isOwner'] : '');
 $user->save();

 $person = Models\Person::where('id', $data['person'])->first();
 $person->user_id = $user['id'];
 $person->save();

 return $user;
}

public static function getUsers(){
  return Models\User::select('id', 'name')->get()->toArray();
}

public static function getPerson(){
 $user = Auth::user();

 if(Users::checkAdmin($user)){
   $blank['id'] = '%';
   return $blank;
 }

 if($user){
  $id = $user->id;

  $person = Models\Person::where('user_id', $id)->first();

  if($person){
    $person = $person->toArray();
    return $person;
  }
}

return false;
}

public static function getCurrentUser(){
  return $user = Auth::user();
}

}