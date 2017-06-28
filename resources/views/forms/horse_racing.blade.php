
<legend>Racing</legend>

<div class="row">
  <div class="col-sm-5">
    <fieldset>
      <legend>Stats</legend>
      <div class="form-group">
        <label for="speed" class="col-sm-6 control-label">Speed</label>
        <div class="col-sm-6">
          <input type="number" name="speed" class="form-control" placeholder="0" value="{{ $horse['speed'] }}" />
        </div>
      </div>

      <div class="form-group">
        <label for="staying" class="col-sm-6 control-label">Staying</label>
        <div class="col-sm-6">
          <input type="number" name="staying" class="form-control" placeholder="0" value="{{ $horse['staying'] }}" />
        </div>
      </div>

      <div class="form-group">
        <label for="stamina" class="col-sm-6 control-label">Stamina</label>
        <div class="col-sm-6">
          <input type="number" name="stamina" class="form-control" placeholder="0" value="{{ $horse['stamina'] }}" />
        </div>
      </div>

      <div class="form-group">
        <label for="breaking" class="col-sm-6 control-label">Breaking</label>
        <div class="col-sm-6">
          <input type="number" name="breaking" class="form-control" placeholder="0" value="{{ $horse['breaking'] }}" />
        </div>
      </div>

      <div class="form-group">
        <label for="power" class="col-sm-6 control-label">Power</label>
        <div class="col-sm-6">
          <input type="number" name="power" class="form-control" placeholder="0" value="{{ $horse['power'] }}" />
        </div>
      </div>

      <div class="form-group">
        <label for="feel" class="col-sm-6 control-label">Feel</label>
        <div class="col-sm-6">
          <input type="number" name="feel" class="form-control" placeholder="0" value="{{ $horse['feel'] }}" />
        </div>
      </div>

      <div class="form-group">
        <label for="fierce" class="col-sm-6 control-label">Fierce</label>
        <div class="col-sm-6">
          <input type="number" name="fierce" class="form-control" placeholder="0" value="{{ $horse['fierce'] }}" />
        </div>
      </div>

      <div class="form-group">
        <label for="tenacity" class="col-sm-6 control-label">Tenacity</label>
        <div class="col-sm-6">
          <input type="number" name="tenacity" class="form-control" placeholder="0" value="{{ $horse['tenacity'] }}" />
        </div>
      </div>

      <div class="form-group">
        <label for="courage" class="col-sm-6 control-label">Courage</label>
        <div class="col-sm-6">
          <input type="number" name="courage" class="form-control" placeholder="0" value="{{ $horse['courage'] }}" />
        </div>
      </div>

      <div class="form-group">
        <label for="response" class="col-sm-6 control-label">Response</label>
        <div class="col-sm-6">
          <input type="number" name="response" class="form-control" placeholder="0" value="{{ $horse['response'] }}" />
        </div>
      </div>
    </fieldset>
  </div>

  <div class="col-sm-7">
    <fieldset>
      <legend>Surface</legend>
      <div class="form-group">
        <label for="surface-dirt" class="col-sm-4 control-label">
          Dirt
        </label>
        <div class="col-sm-8">
          <select name="surface_dirt" class="form-control">
            <option> </option>
            @foreach ($domain['surface_pref'] as $s)
            <option @if( $horse['surface_dirt'] == $s['id']) selected @endif value="{{$s['id']}}">{{$s['value']}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="surface-turf" class="col-sm-4 control-label">
          Turf
        </label>
        <div class="col-sm-8">
         <select name="surface_dirt" class="form-control">
          <option> </option>
          @foreach ($domain['surface_pref'] as $s)
          <option @if( $horse['surface_turf'] == $s['id']) selected @endif value="{{$s['id']}}">{{$s['value']}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </fieldset>

  <fieldset>
    <legend>Other</legend>
    <div class="form-group">
      <label for="leg-type" class="col-sm-4 control-label">
        Leg Type
      </label>
      <div class="col-sm-8">
       <select name="leg_type" class="form-control">
        <option> </option>
        @foreach ($domain['leg_types'] as $s)
        <option @if( $horse['leg_type'] == $s['id']) selected @endif value="{{$s['id']}}">{{$s['value']}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="neck-height" class="col-sm-4 control-label">
      Neck Height
    </label>
    <div class="col-sm-8">
     <select name="neck_height" class="form-control">
      <option> </option>
      @foreach ($domain['neck_height'] as $s)
      <option @if( $horse['neck_height'] == $s['id']) selected @endif value="{{$s['id']}}">{{$s['value']}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <label for="run-style" class="col-sm-4 control-label">
    Run Style
  </label>
  <div class="col-sm-8">
    <select name="run_style" class="form-control">
      <option> </option>
      @foreach ($domain['run_style'] as $s)
      <option @if( $horse['run_style'] == $s['id']) selected @endif value="{{$s['id']}}">{{$s['value']}}</option>
      @endforeach
    </select>
  </div>
</div>
</fieldset>

<fieldset>
  <legend>Equipment</legend>
  <div class="form-group">
    <label for="bandages" class="col-sm-4 control-label">
      Bandages
    </label>
    <div class="col-sm-8">
      <select name="bandages" class="form-control">
        <option> </option>
        @foreach ($domain['bandages'] as $s)
        <option @if( $horse['bandages'] == $s['id']) selected @endif value="{{$s['id']}}">{{$s['value']}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="hood" class="col-sm-4 control-label">
      Hood
    </label>
    <div class="col-sm-8">
      <select name="hood" class="form-control">
        <option> </option>
        @foreach ($domain['hood'] as $s)
        <option @if( $horse['hood'] == $s['id']) selected @endif value="{{$s['id']}}">{{$s['value']}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="shadow-roll" class="col-sm-4 control-label">
      Shadow Roll
    </label>
    <div class="col-sm-8">
      <select name="shadow_roll" class="form-control">
        <option> </option>
        @foreach ($domain['shadow_roll'] as $s)
        <option @if( $horse['shadow_roll'] == $s['id']) selected @endif value="{{$s['id']}}">{{$s['value']}}</option>
        @endforeach
      </select>
    </div>
  </div>
</fieldset>
</div>
</div>

<fieldset>

  <legend>Abilities</legend>

  <div class="form-group">
    <label for="pos_ability_1" class="col-sm-2 control-label">
      <i class="fa fa-plus text-success"></i>
    </label>
    <div class="col-sm-10">
      <select name="pos_ability_1" class="form-control">
        <option> </option>
        @foreach ($domain['pos_abilities'] as $pos)
        <option @if( $horse['pos_ability_1'] == $pos['id']) selected @endif value="{{$pos['id']}}">{{$pos['ability']}}: {{$pos['description']}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="pos_ability_2" class="col-sm-2 control-label">
      <i class="fa fa-plus text-success"></i>
    </label>
    <div class="col-sm-10">
      <select name="pos_ability_2" class="form-control">
        <option> </option>
        @foreach ($domain['pos_abilities'] as $pos)
        <option @if( $horse['pos_ability_2'] == $pos['id']) selected @endif value="{{$pos['id']}}">{{$pos['ability']}}: {{$pos['description']}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="neg_ability_1" class="col-sm-2 control-label">
      <i class="fa fa-minus text-danger"></i>
    </label>
    <div class="col-sm-10">
      <select name="neg_ability_1" class="form-control">
        <option> </option>
        @foreach ($domain['neg_abilities'] as $neg)
        <option @if( $horse['neg_ability_1'] == $neg['id']) selected @endif value="{{$neg['id']}}">{{$neg['ability']}}: {{$neg['description']}}</option>
        @endforeach
      </select>
    </div>
  </div>
</fieldset>


<fieldset>
  <legend>Distance</legend>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="distance_min" class="col-sm-4 control-label">Min</label>
        <div class="col-sm-8">
          <div class="input-group">
            <input type="number" name="distance_min" class="form-control" placeholder="0" value="{{ $horse['distance_min'] }}" step="any" min="0">
            <span class="input-group-addon"><small>Furlongs</small></span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="distance_max" class="col-sm-4 control-label">Max</label>
        <div class="col-sm-8">
          <div class="input-group">
            <input type="number" name="distance_max" class="form-control" placeholder="0" value="{{ $horse['distance_max'] }}" step="any" min="0">
            <span class="input-group-addon"><small>Furlongs</small></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</fieldset>