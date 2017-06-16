
<legend>Racing</legend>

<div class="row">
  <div class="col-sm-4">
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

  <div class="col-sm-8">
    <fieldset>
      <legend>Surface</legend>
      <div class="form-group">
        <label for="surface-dirt" class="col-sm-3 control-label">
          Dirt
        </label>
        <div class="col-sm-9">         
          @foreach ($domain['surface_pref'] as $surface)    
          <label class="radio-inline">
            <input type="radio" name="surface_dirt" value="{{$surface['id']}}" 
            @if($horse['surface_dirt'] == $surface['id']) checked @endif>
            {{$surface['value']}}
          </label>   
          @endforeach
        </div>  
      </div> 

      <div class="form-group">
        <label for="surface-turf" class="col-sm-3 control-label">
          Turf
        </label>
        <div class="col-sm-9">        
          @foreach ($domain['surface_pref'] as $surface)      
          <label class="radio-inline">
            <input type="radio" name="surface_turf" value="{{$surface['id']}}" 
            @if($horse['surface_turf'] == $surface['id']) checked @endif>
            {{$surface['value']}}
          </label>
          @endforeach               
        </div>
      </div> 
    </fieldset>

    <fieldset>
      <legend>Other</legend>
      <div class="form-group">
        <label for="leg-type" class="col-sm-3 control-label">
          Leg Type
        </label>
        <div class="col-sm-9">
          @foreach ($domain['leg_types'] as $leg_types) 
          <input type="radio" name="leg_type" value="{{$leg_types['id']}}" 
          @if($horse['leg_type'] == $leg_types['id']) checked @endif>
          {{$leg_types['value']}}
          <br>
          @endforeach  
        </div>
      </div>

      <div class="form-group">
        <label for="neck-height" class="col-sm-3 control-label">
          Neck Height
        </label>
        <div class="col-sm-9"> 
          @foreach ($domain['neck_height'] as $neck_height)  
          <label class="radio-inline">
            <input type="radio" name="neck_height" value="{{$neck_height['id']}}" 
            @if($horse['neck_height'] == $neck_height['id']) checked @endif>
            {{$neck_height['value']}}
          </label>   
          @endforeach   
        </div>
      </div>

      <div class="form-group">
        <label for="run-style" class="col-sm-3 control-label">
          Run Style
        </label>
        <div class="col-sm-9">
          @foreach ($domain['run_style'] as $run_style)   
          <label class="radio-inline">
            <input type="radio" name="run_style" value="{{$run_style['id']}}" 
            @if($horse['run_style'] == $run_style['id']) checked @endif>
            {{$run_style['value']}}
          </label>   
          @endforeach  
        </div>
      </div>
    </fieldset>

    <fieldset>
      <legend>Equipment</legend>
      <div class="form-group">
        <label for="bandages" class="col-sm-3 control-label">
          Bandages
        </label>
        <div class="col-sm-9"> 
          @foreach ($domain['bandages'] as $bandages) 
          <label class="radio-inline">
            <input type="radio" name="bandages" value="{{$bandages['id']}}" 
            @if($horse['bandages'] == $bandages['id']) checked @endif>
            {{$bandages['value']}}
          </label>    
          @endforeach  
        </div>
      </div>  

      <div class="form-group">
        <label for="hood" class="col-sm-3 control-label">
          Hood
        </label>
        <div class="col-sm-9">             
          @foreach ($domain['hood'] as $hood)
          <label class="radio-inline">
            <input type="radio" name="hood" value="{{$hood['id']}}" 
            @if($horse['hood'] == $hood['id']) checked @endif>
            {{$hood['value']}}
          </label> 
          @endforeach             
        </div>
      </div>

      <div class="form-group">
        <label for="shadow-roll" class="col-sm-3 control-label">
          Shadow Roll
        </label>
        <div class="col-sm-9">             
          @foreach ($domain['shadow_roll'] as $shadow_roll) 
          <label class="radio-inline">
            <input type="radio" name="shadow_roll" value="{{$shadow_roll['id']}}" @if($horse['shadow_roll'] == $shadow_roll['id']) checked @endif>
            {{$shadow_roll['value']}}
          </label>   
          @endforeach          
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