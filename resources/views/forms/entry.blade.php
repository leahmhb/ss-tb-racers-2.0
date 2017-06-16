
<input type="text" readonly class="form-control hidden" name="id" id="id" placeholder="" value="{{ $entry['id'] }}">
<fieldset>
  <legend>Race</legend>

  <div class="form-group">     
    <label for="race_id" class="col-sm-3 control-label">
      <small>
        <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
      </small>
      Name
    </label>
    <div class="col-sm-9">
      <select name="race_id" class="form-control">
        <option> </option>
        @foreach ($options['races'] as $race)          
        <option @if($race['id'] == $entry['race_id']) selected @endif value="{{$race['id']}}"> 
          {{ $race['series'] }}  
          {{ $race['name'] }}
          {{ $race['surface'] }} 
          {{ $race['distance'] }}F 
          {{ $race['grade'] }} 
          {{ date('M-d-Y', strtotime($race['ran_dt']))}} 
        </option>
        @endforeach
      </select>             
    </div>        
  </div> 
</fieldset>

<fieldset>
  <legend>Entry</legend>

  <div class="form-group">
    <label for="horse_id" class="col-sm-3 control-label">
      <small>
        <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
      </small>
      Name
    </label>
    <div class="col-sm-9">
      <select name="horse_id" class="form-control">
        <option> </option>
        @foreach ($options['my_horses'] as $h)          
        <option value="{{$h['id']}}" @if($entry['horse_id'] == $h['id']) selected @endif>{{$h['call_name']}}</option>
        @endforeach
      </select>           
    </div>        
  </div> 

  <div class="form-group">
    <label for="placing" class="col-sm-3 control-label">
      <small>
        <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
      </small>
      Placing
    </label>            
    <div class="col-sm-9">     
      <input type="number" name="placing" class="form-control" value="{{ $entry['placing'] }}"  placeholder="0 for Unran Races" />       
    </div> 
  </div>
</fieldset>

<fieldset>
  <legend>Additional Details</legend>

  <div class="form-group">
    <label for="isNotableWin" class="col-sm-3 control-label">     
      Notable Win
    </label>            
    <div class="col-sm-9">     
     <label class="radio-inline">
      <input type="radio" name="isNotableWin" value="YES" @if($entry['isNotableWin'] == "YES") checked @endif>
      Yes
    </label>
    <label class="radio-inline">
      <input type="radio" name="isNotableWin" value="NO" @if($entry['isNotableWin'] == "NO") checked @endif>
      No
    </label>    
  </div> 
</div>


<div class="form-group">
  <label for="isTrackRecord" class="col-sm-3 control-label">  
    Track Record
  </label>            
  <div class="col-sm-9">     
   <label class="radio-inline">
    <input type="radio" name="isTrackRecord" value="YES" @if($entry['isTrackRecord'] == "YES") checked @endif>
    Yes
  </label>
  <label class="radio-inline">
    <input type="radio" name="isTrackRecord" value="NO" @if($entry['isTrackRecord'] == "NO") checked @endif>
    No
  </label>    
</div> 
</div>

<div class="form-group">
  <label for="time" class="col-sm-3 control-label">
    Time
  </label>            
  <div class="col-sm-9">     
  <input type="text" name="time" class="form-control" value="{{ $entry['time'] }}"  placeholder="1:50.1" />       
  </div> 
</div>
</fieldset>

