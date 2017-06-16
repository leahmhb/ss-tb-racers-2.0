
<fieldset>
  <legend>Basics</legend>

  <div class="form-group">
    <label for="call-name" class="col-sm-2 control-label">
      <small>
        <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
      </small>
      Call Name          
    </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="call_name" id="call-name" placeholder="..." value="{{ $horse['call_name'] }}" />
    </div>
  </div>

  <div class="form-group">
    <label for="sex" class="col-sm-2 control-label">
      <small>
        <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
      </small>
      Sex
    </label>
    <div class="col-sm-10">
      @foreach ($domain['sexes'] as $sex)           
      <label class="radio-inline">
        <input type="radio" name="sex" value="{{$sex['id']}}" @if($horse['sex'] == $sex['id']) checked @endif>
        {{$sex['value']}}
      </label>            
      @endforeach       
    </div>        
  </div>   

  <div class="form-group">
    <label for="grade" class="col-sm-2 control-label">
      <small>
        <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
      </small>
      Grade
    </label>
    <div class="col-sm-10">
      @foreach ($domain['grades'] as $grade)           
      <label class="radio-inline">
        <input type="radio" name="grade" value="{{$grade['id']}}" @if($horse['grade'] == $grade['id']) checked @endif>
        {{$grade['description']}}
      </label>            
      @endforeach
    </div>
  </div>

  <div class="form-group">
    <label for="stall_path" class="col-sm-2 control-label">
      Stall Page</label>
      <div class="col-sm-10">
        <div class="input-group">
        <input type="text" class="form-control" name="stall_path" id="stall_path" placeholder="leave blank if database is primary stall page" value="{{$horse['stall_path']}}" />
          <span class="input-group-addon">
            <small>
              <i class="fa fa-link fa-color"></i>
            </small>
          </span>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="owner" class="col-sm-2 control-label">
        <small>
          <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
        </small>
        Owner
      </label>
      <div class="col-sm-10">       
        <select name="owner" class="form-control">
          @if($owner)
          <option value ="{{$owner['id']}}">{{$owner['username']}}</option>
          @else 
          <option> </option>
          @foreach ($domain['person'] as $person)          
          <option @if( $horse['owner'] == $person['id']) selected @endif value="{{$person['id']}}">{{$person['username']}}</option>
          @endforeach
          @endif
        </select>
      </div>                
    </div>

  </fieldset>
