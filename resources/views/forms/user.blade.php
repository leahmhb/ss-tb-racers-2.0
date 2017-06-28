<input name="id" class="form-control hidden" readonly id="id" value="{{ $user['id'] }}">

<div id="user_id" class="form-group">
  <label for="user" class="col-sm-2 control-label">
   <small>
     <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
   </small>
   User's Name
 </label>
 <div class="col-sm-10">
  <select name="user" class="form-control">
    <option> </option>
    @foreach ($users as $p)
    <option @if( $p['id'] === $user['id']) selected @endif value="{{$p['id']}}">
      {{$p['name']}}
    </option>
    @endforeach
  </select>
</div>
</div>

<fieldset>
  <legend>Permissions</legend>

  <div class="form-group">
    <label for="isOwner" class="col-sm-2 control-label">
     <small>
       <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
     </small>
     Owner
   </label>
   <div class="col-sm-10">
     <label class="radio-inline">
       <input id="isOwner" type="radio" name="isOwner" value="1" @if($user['isOwner'] == 1) checked @endif>
       Yes
     </label>
     <label class="radio-inline">
      <input id="isNotOwner" type="radio" name="isOwner" value="0" @if($user['isOwner'] == 0) checked @endif>
      No
    </label>
  </div>
</div>

<div class="form-group">
  <label for="isAdmin" class="col-sm-2 control-label">
   <small>
     <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
   </small>
   Admin
 </label>
 <div class="col-sm-10">
   <label class="radio-inline">
    <input type="radio" name="isAdmin" value="1" @if($user['isAdmin'] == 1) checked @endif>
    Yes
  </label>

  <label class="radio-inline">
    <input type="radio" name="isAdmin" value="0" @if($user['isAdmin'] == 0) checked @endif>
    No
  </label>
</div>
</div>

<div class="form-group">
  <label for="isJockeyClub" class="col-sm-2 control-label">
   <small>
     <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
   </small>
   Jockey Club
 </label>
 <div class="col-sm-10">
   <label class="radio-inline">
    <input type="radio" name="isJockeyClub" value="1" @if($user['isJockeyClub'] == 1) checked @endif>
    Yes
  </label>

  <label class="radio-inline">
    <input type="radio" name="isJockeyClub" value="0" @if($user['isJockeyClub'] == 0) checked @endif>
    No
  </label>
</div>
</div>
</fieldset>