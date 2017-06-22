<div class="row">
  <div class="col-sm-6">
    <fieldset>
      <legend>Basics</legend>
      <div class="form-group">
       <label for="call-name" class="col-sm-2 control-label">
         Call Name
       </label>
       <div class="col-sm-10">
        <input type="text" class="form-control" name="call_name" id="call-name" placeholder="..." value="" />
      </div>
    </div>

    <div class="form-group">
     <label for="color" class="col-sm-2 control-label">
       Color
     </label>
     <div class="col-sm-10">
      <input type="text" class="form-control" name="color" id="color" placeholder="..." value="" />
    </div>
  </div>

  <div class="form-group">
    <label for="sex" class="col-sm-2 control-label">
     Sex
   </label>
   <div class="col-sm-10">
    <select name="sex" class="form-control">
      <option> </option>
      @foreach ($domain['sexes'] as $sex)
      <option value="{{$sex['value']}}">{{$sex['value']}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <label for="racing_img" class="col-sm-2 control-label">
    Racing Image
  </label>
  <div class="col-sm-10">
   <div class="input-group">
     <input type="text" class="form-control" name="racing_img" id="racing_img" placeholder="img" value="" />
     <span class="input-group-addon">
      <small>
        <i class="fa fa-picture-o fa-color"></i>
      </small>
    </span>
  </div>
</div>
</div>

<div class="form-group">
  <label for="owner" class="col-sm-2 control-label">
   Owner
 </label>
 <div class="col-sm-10">
   <input type="text" class="form-control" name="owner" id="owner" placeholder="..." value="" />
 </div>
</div>

<div class="form-group">
  <label for="stablename" class="col-sm-2 control-label">
   Stable Name
 </label>
 <div class="col-sm-10">
   <input type="text" class="form-control" name="stable_name" id="stable_name" placeholder="..." value="" />
 </div>
</div>

<div class="form-group">
  <label for="racing_colors" class="col-sm-2 control-label">
   Racing Colors
 </label>
 <div class="col-sm-10">
   <input type="text" class="form-control" name="racing_colors" id="racing_colors" placeholder="..." value="" />
 </div>
</div>
</fieldset>


<fieldset>
  <legend>Abilities</legend>
  <div class="form-group">
    <label for="pos-ability-1" class="col-sm-2 control-label"><i class="fa fa-plus text-success"></i></label>
    <div class="col-sm-10">
      <select name="pos_ability_1" class="form-control">
       <option> </option>
       @foreach ($domain['pos_abilities'] as $pos)
       <option value="{{$pos['ability']}}">{{$pos['ability']}}: {{$pos['description']}}</option>
       @endforeach
     </select>
   </div>
 </div>

 <div class="form-group">
  <label for="pos-ability-2" class="col-sm-2 control-label"><i class="fa fa-plus text-success"></i></label>
  <div class="col-sm-10">
    <select name="pos_ability_2" class="form-control">
     <option> </option>
     @foreach ($domain['pos_abilities'] as $pos)
     <option value="{{$pos['ability']}}">{{$pos['ability']}}: {{$pos['description']}}</option>
     @endforeach
   </select>
 </div>
</div>

<div class="form-group">
  <label for="neg-ability-1" class="col-sm-2 control-label">
    <i class="fa fa-minus text-warning"></i>
  </label>
  <div class="col-sm-10">
    <select name="neg_ability_1" class="form-control">
     <option> </option>
     @foreach ($domain['neg_abilities'] as $neg)
     <option value="{{$neg['ability']}}">{{$neg['ability']}}: {{$neg['description']}}</option>
     @endforeach
   </select>
 </div>
</div>
</fieldset>

</div>
<div class="col-sm-6">
<fieldset>
  <legend>Distance</legend>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="distance-min" class="col-sm-4 control-label">Min</label>
        <div class="col-sm-8">
          <div class="input-group">
            <input type="number" name="distance_min" class="form-control" placeholder="0" value="" step="any" min="0">
            <span class="input-group-addon"><small>Furlongs</small></span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="distance-min" class="col-sm-4 control-label">Max</label>
        <div class="col-sm-8">
          <div class="input-group">
            <input type="number" name="distance_max" class="form-control" placeholder="0" value="" step="any" min="0">
            <span class="input-group-addon"><small>Furlongs</small></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</fieldset>
  <div class="row">
    <div class="col-sm-4">
      <fieldset>
        <legend>Stats</legend>

        <div class="form-group">
          <label for="speed" class="col-sm-6 control-label">Speed</label>
          <div class="col-sm-6">
            <input type="number" name="speed" class="form-control" placeholder="50" value="50" />
          </div>
        </div>

        <div class="form-group">
          <label for="staying" class="col-sm-6 control-label">Staying</label>
          <div class="col-sm-6">
            <input type="number" name="staying" class="form-control" placeholder="50" value="50" />
          </div>
        </div>

        <div class="form-group">
          <label for="stamina" class="col-sm-6 control-label">Stamina</label>
          <div class="col-sm-6">
            <input type="number" name="stamina" class="form-control" placeholder="50" value="50" />
          </div>
        </div>

        <div class="form-group">
          <label for="breaking" class="col-sm-6 control-label">Breaking</label>
          <div class="col-sm-6">
            <input type="number" name="breaking" class="form-control" placeholder="50" value="50" />
          </div>
        </div>

        <div class="form-group">
          <label for="power" class="col-sm-6 control-label">Power</label>
          <div class="col-sm-6">
            <input type="number" name="power" class="form-control" placeholder="50" value="50" />
          </div>
        </div>

        <div class="form-group">
          <label for="feel" class="col-sm-6 control-label">Feel</label>
          <div class="col-sm-6">
            <input type="number" name="feel" class="form-control" placeholder="50" value="50" />
          </div>
        </div>

        <div class="form-group">
          <label for="fierce" class="col-sm-6 control-label">Fierce</label>
          <div class="col-sm-6">
            <input type="number" name="fierce" class="form-control" placeholder="50" value="50" />
          </div>
        </div>

        <div class="form-group">
          <label for="tenacity" class="col-sm-6 control-label">Tenacity</label>
          <div class="col-sm-6">
            <input type="number" name="tenacity" class="form-control" placeholder="50" value="50" />
          </div>
        </div>

        <div class="form-group">
          <label for="courage" class="col-sm-6 control-label">Courage</label>
          <div class="col-sm-6">
            <input type="number" name="courage" class="form-control" placeholder="50" value="50" />
          </div>
        </div>

        <div class="form-group">
          <label for="response" class="col-sm-6 control-label">Response</label>
          <div class="col-sm-6">
            <input type="number" name="response" class="form-control" placeholder="50" value="50" />
          </div>
        </div>
      </fieldset>
    </div>

    <div class="col-sm-8">
      <fieldset>
        <legend>Surface</legend>

        <div class="form-group">
          <label for="surface-dirt" class="col-sm-3 control-label">Dirt</label>
          <div class="col-sm-9">
           @foreach ($domain['surface_pref'] as $surface)
           <label class="radio-inline">
            <input type="radio" name="surface_dirt" value="{{$surface['value']}}">
            {{$surface['value']}}
          </label>
          @endforeach
        </div>
      </div>

      <div class="form-group">
        <label for="surface-turf" class="col-sm-3 control-label">Turf</label>
        <div class="col-sm-9">
         @foreach ($domain['surface_pref'] as $surface)
         <label class="radio-inline">
          <input type="radio" name="surface_turf" value="{{$surface['value']}}">
          {{$surface['value']}}
        </label>
        @endforeach
      </div>
    </div>
  </fieldset>


  <fieldset>
    <legend>Other</legend>

    <div class="form-group">
      <label for="leg-type" class="col-sm-3 control-label">Leg Type</label>
      <div class="col-sm-9">
       @foreach ($domain['leg_types'] as $leg_types)
       <label class="radio-inline">
        <input type="radio" name="leg_type" value="{{$leg_types['value']}}">
        {{$leg_types['value']}}
      </label>
      @endforeach
    </div>
  </div>

  <div class="form-group">
    <label for="neck-height" class="col-sm-3 control-label">Neck Height</label>
    <div class="col-sm-9">
     @foreach ($domain['neck_height'] as $neck_height)
     <label class="radio-inline">
      <input type="radio" name="neck_height" value="{{$neck_height['value']}}">
      {{$neck_height['value']}}
    </label>
    @endforeach
  </div>
</div>

<div class="form-group">
  <label for="run-style" class="col-sm-3 control-label">Run Style</label>
  <div class="col-sm-9">
   @foreach ($domain['run_style'] as $run_style)
   <label class="radio-inline">
    <input type="radio" name="run_style" value="{{$run_style['value']}}">
    {{$run_style['value']}}
  </label>
  @endforeach
</div>
</div>
</fieldset>

<fieldset>
  <legend>Equipment</legend>

  <div class="form-group">
    <label for="bandages" class="col-sm-3 control-label">Bandages</label>
    <div class="col-sm-9">
     @foreach ($domain['bandages'] as $bandages)
     <label class="radio-inline">
      <input type="radio" name="bandages" value="{{$bandages['value']}}">
      {{$bandages['value']}}
    </label>
    @endforeach
  </div>
</div>

<div class="form-group">
  <label for="hood" class="col-sm-3 control-label"> Hood</label>
  <div class="col-sm-9">
    @foreach ($domain['hood'] as $hood)
    <label class="radio-inline">
      <input type="radio" name="hood" value="{{$hood['value']}}">
      {{$hood['value']}}
    </label>
    @endforeach
  </div>
</div>

<div class="form-group">
  <label for="shadow-roll" class="col-sm-3 control-label">Shadow Roll</label>
  <div class="col-sm-9">
   @foreach ($domain['shadow_roll'] as $shadow_roll)
   <label class="radio-inline">
    <input type="radio" name="shadow_roll" value="{{$shadow_roll['value']}}">
    {{$shadow_roll['value']}}
  </label>
  @endforeach
</div>
</div>
</fieldset>
</div>

</div>
</div>
</div>

