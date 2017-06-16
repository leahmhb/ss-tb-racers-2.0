
<input type="text" class="form-control hidden" readonly name="id" id="id" value="{{ $race['id'] }}">
<fieldset>
  <legend>Basic</legend>
  <div class="form-group">
    <label for="series" class="col-sm-2 control-label">Series</label>
    <div class="col-sm-10">
      <select name="series" class="form-control">
        <option value="44"></option>
        @foreach ($options['series'] as $race_series)          
        <option @if( $race['series'] === $race_series['id']) selected @endif value="{{$race_series['id']}}">{{$race_series['description']}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">
      <small><i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i></small>
      Name
    </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" id="name" value="{{ $race['name'] }}" placeholder="...">
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="distance" class="col-sm-4 control-label">
          <small><i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i></small>
          Distance
        </label>            
        <div class="col-sm-8"> 
          <div class="input-group">
            <input type="number" name="distance" class="form-control" value="{{ $race['distance'] }}" step="any" min="0">
            <span class="input-group-addon"><small>Furlongs</small></span>
          </div> 
        </div> 
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="surface" class="col-sm-4 control-label">
          <small><i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i></small>
          Surface
        </label>
        <div class="col-sm-8">             
          @foreach ($options['surfaces'] as $surface)    
          <label class="radio-inline">
            <input type="radio" name="surface" value="{{$surface['id']}}" @if($race['surface'] == $surface['id']) checked @endif>
            {{$surface['value']}}
          </label>   
          @endforeach 
        </div>
      </div> 
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
      @foreach ($options['grades'] as $grade)    
      <label class="radio-inline">
        <input type="radio" name="grade" value="{{$grade['id']}}" @if($race['grade'] == $grade['id']) checked @endif>
        {{$grade['description']}}
      </label>   
      @endforeach
    </div>
  </div>   
</fieldset>

<fieldset>
  <legend>Details</legend>

  <div class="form-group">
    <label for="url" class="col-sm-2 control-label">
      <small>
        <i class="text-info fa fa-star-o" data-toggle="tooltip" data-placement="top" title="Recommended"></i>
      </small> 
      URL
    </label>            
    <div class="col-sm-10">    
      <div class="input-group">     
        <input type="text" name="url" class="form-control" value="{{ $race['url'] }}" placeholder="www">
        <span class="input-group-addon">
          <small>
            <i class="fa fa-link fa-color"></i>
          </small>
        </span>
      </div>
    </div> 
  </div>

  <div class="form-group">
    <label for="date" class="col-sm-2 control-label">
      <small>
        <i class="text-info fa fa-star-o" data-toggle="tooltip" data-placement="top" title="Recommended"></i>
      </small> 
      Date
    </label>
    <div class="col-sm-10">
      <div class="input-group date" data-provide="datepicker">
        <input type="text" name="ran_dt" class="datepicker form-control" data-date-format="yyyy-mm-dd" value="@if($race['ran_dt']) {{ date('Y-m-d', strtotime($race['ran_dt']))}} @endif">
        <div class="input-group-addon"><small><i class="fa fa-calendar fa-color"></i></small></div>
      </div>  
    </div>
    <span class="form_notes">1000-01-01 for Unran Races. 1111-11-11 for Unknown Dates.</span>
  </div>

  <div class="form-group">
    <label for="weather" class="col-sm-2 control-label">
      Weather
    </label>            
    <div class="col-sm-10">     
      <input type="text" name="weather" class="form-control" value="{{ $race['weather'] }}"  placeholder="..." />       
    </div> 
  </div>


  <div class="form-group">
    <label for="course" class="col-sm-2 control-label">
      Course
    </label>            
    <div class="col-sm-10">     
      <input type="text" name="course" class="form-control" value="{{ $race['course'] }}"  placeholder="..." />       
    </div> 
  </div>

  <div class="form-group">
    <label for="final_time" class="col-sm-2 control-label">
      Final Time
    </label>            
    <div class="col-sm-10">     
      <input type="text" name="final_time" class="form-control" value="{{ $race['final_time'] }}"  placeholder="1:50.1" />       
    </div>
  </div>

</fieldset>
