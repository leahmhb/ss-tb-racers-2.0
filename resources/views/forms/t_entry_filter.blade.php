<form id="entry-filter" class="form-horizontal" method="post" action="/entry-table">
 <aside class="row">
  <div class="col-sm-12">
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">Filter</h3></div>
      <div class="panel-body">

        <div class="col-sm-6">
          <div class="form-group">
            <label for="race" class="col-sm-2 control-label">Race</label>
            <div class="col-sm-10">       
              <select name="race" class="form-control" id="race">
                <option value="0">All</option>        
                @foreach ($domain['races'] as $r)          
                <option @if($race == $r['id']) selected @endif value="{{$r['id']}}">{{ $r['series'] }} {{ $r['name'] }} {{ $r['distance'] }}F {{ $r['surface'] }} {{ $r['grade'] }}</option>
                @endforeach         
              </select>
            </div>                
          </div>
        </div>

        <div class="col-sm-6">
         <div class="form-group">
          <label for="grade" class="col-sm-2 control-label">Placing</label>
          <div class="col-sm-10">
            <select name="placing" class="form-control" id="placing">    
              @for ($i = 0; $i <= 14; $i++)
              <option value="{{$i}}" @if($placing == $i) selected @endif>
                @if($i == 0)
                All
                @else
                {{ $i }}
                @endif   
              </option>         
              @endfor
            </select>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
       <div class="form-group">
         <label for="horse" class="col-sm-2 control-label">Horse</label>
         <div class="col-sm-10">
          <select name="horse" class="form-control" id="horse">
            <option value="0">All</option>
            @foreach ($domain['horses'] as $h)          
            <option @if($horse == $h['id']) selected @endif value="{{$h['id']}}">{{$h['call_name']}}</option>
            @endforeach
          </select>           
        </div>        
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        <label for="owner" class="col-sm-2 control-label">Owner</label>
        <div class="col-sm-10">       
          <select name="owner" class="form-control" id="owner">
            <option value="0">All</option>       
            @foreach ($domain['person'] as $person)          
            <option @if($owner == $person['id']) selected @endif value="{{$person['id']}}">{{$person['username']}}</option>
            @endforeach         
          </select>
        </div>                
      </div>
    </div>

    

  </div>    
  <div class="panel-footer">
    <div class="text-right"> 
      <button id="t_entry_filter_reset" type="reset" class="btn btn-default btn-sm">Reset</button> 
      <button type="submit" class="btn btn-primary btn-sm">Save</button> 
    </div>
  </div>

</div> 
</div>
</aside>
</form>