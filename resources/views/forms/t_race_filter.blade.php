<form id="race-filter" class="form-horizontal" method="post" action="/race-table">
 <aside class="row">
  <div class="col-sm-12">
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">Filter</h3></div>
      <div class="panel-body">

        <div class="col-sm-6">
          <div class="form-group">
            <label for="grade" class="col-sm-2 control-label">Grade</label>
            <div class="col-sm-10">       
              <select name="grade" class="form-control" id="grade">
                <option value="0">All</option>        
                @foreach ($domain['grade'] as $g)          
                <option @if($grade == $g['id']) selected @endif value="{{$g['id']}}"> {{ $g['description'] }} </option>
                @endforeach         
              </select>
            </div>                
          </div>
        </div>

        <div class="col-sm-6">
         <div class="form-group">
          <label for="surface" class="col-sm-2 control-label">Surface</label>
          <div class="col-sm-10">
            <select name="surface" class="form-control" id="surface">    
              <option value="0">All</option>        
              @foreach ($domain['surface'] as $s)          
              <option @if($surface == $s['id']) selected @endif value="{{$s['id']}}"> {{ $s['value'] }} </option>
              @endforeach    
            </select>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
       <div class="form-group">
         <label for="series" class="col-sm-2 control-label">Series</label>
         <div class="col-sm-10">
          <select name="series" class="form-control" id="series">
            <option value="0">All</option>
            @foreach ($domain['series'] as $s)          
            <option @if($series == $s['id']) selected @endif value="{{$s['id']}}">{{$s['description']}}</option>
            @endforeach
          </select>           
        </div>        
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        <label for="distance" class="col-sm-2 control-label">Distance</label>
        <div class="col-sm-10">       
          <select name="distance" class="form-control" id="distance">   
           <option value="0" @if($distance == 0) selected @endif>All</option>  
            @for ($i = 6; $i < 20; $i++)
            <option value="{{$i}}" @if($distance == $i) selected @endif>             
              {{ $i }}F             
            </option>         
            @endfor      
          </select>
        </div>                
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        <label for="year" class="col-sm-2 control-label">Year</label>
        <div class="col-sm-10">       
        <select name="year" class="form-control" id="year"> 
         <option value="0" @if($year == 0) selected @endif>All</option>
            @for ($i = 2009; $i < 2017; $i++)
            <option value="{{$i}}" @if($year == $i) selected @endif>              
              {{ $i }}             
            </option>         
            @endfor    
            <option value="1000" @if($year == 1000) selected @endif>TBA</option>
            <option value="1111" @if($year == 1111) selected @endif>Unknown</option>  
          </select>
        </div>                
      </div>
    </div>

  </div>    
  <div class="panel-footer">
    <div class="text-right"> 
      <button id="t_race_filter_reset" type="reset" class="btn btn-default btn-sm">Reset</button> 
      <button type="submit" class="btn btn-primary btn-sm">Save</button> 
    </div>
  </div>

</div> 
</div>
</aside>
</form>