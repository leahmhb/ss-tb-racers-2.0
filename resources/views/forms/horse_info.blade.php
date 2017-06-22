
<fieldset>
  <legend>Basics</legend>


  <div class="row">
    <div class="col-sm-6">
     <div class="form-group">
       <label for="call-name" class="col-sm-4 control-label">
        <small>
          <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
        </small>
        Call Name
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="call_name" id="call-name" placeholder="..." value="{{ $horse['call_name'] }}" />
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="registered-name" class="col-sm-4 control-label">
        Reg'd Name
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="registered_name" id="registered-name" placeholder="..." value="{{ $horse['registered_name'] }}" />
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="color" class="col-sm-4 control-label">Color</label>
      <div class="col-sm-8">
        <input type="text" name="color" class="form-control" placeholder="..." value="{{ $horse['color'] }}" />
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label for="phenotype" class="col-sm-4 control-label">Phenotype</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="phenotype" id="phenotype" placeholder="..." value="{{ $horse['phenotype'] }}" />
      </div>
    </div>
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
    Breeding Status
  </label>
  <div class="col-sm-10">
    @foreach ($domain['breeding_status'] as $breeding_status)
    <label class="radio-inline">
      <input type="radio" name="breeding_status" value="{{$breeding_status['id']}}" @if($horse['breeding_status'] == $breeding_status['id']) checked @endif>
      {{ $breeding_status['value'] }}
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
  <label for="stall_img" class="col-sm-2 control-label">
    Stall Image
  </label>
  <div class="col-sm-10">
    <div class="input-group">
      <input type="text" class="form-control" name="stall_img" id="stall_img" placeholder="img" value="{{$horse['stall_img']}}" />
      <span class="input-group-addon">
        <small>
          <i class="fa fa-picture-o fa-color"></i>
        </small>
      </span>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="racing_img" class="col-sm-2 control-label">
    Racing Image
  </label>
  <div class="col-sm-10">
    <div class="input-group">
      <input type="text" class="form-control" name="racing_img" id="racing_img" placeholder="img" value="{{$horse['racing_img']}}" />
      <span class="input-group-addon">
        <small>
          <i class="fa fa-picture-o fa-color"></i>
        </small>
      </span>
    </div>
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

  <div class="form-group">
    <label for="breeder" class="col-sm-2 control-label">
      Breeder
    </label>
    <div class="col-sm-10">
      <select name="breeder" class="form-control">
        <option> </option>
        @foreach ($domain['person'] as $person)
        <option @if( $horse['breeder'] == $person['id']) selected @endif value="{{$person['id']}}">{{$person['username']}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="hexer" class="col-sm-2 control-label">
      Hexer
    </label>
    <div class="col-sm-10">
      <select name="hexer" class="form-control">
        <option> </option>
        @foreach ($domain['person'] as $person)
        <option @if( $horse['hexer'] == $person['id']) selected @endif value="{{$person['id']}}">{{$person['username']}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="hexer-name" class="col-sm-2 control-label">Notes</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="notes" rows="10">{{ $horse['notes'] }}</textarea>
    </div>
  </div>
</fieldset>

