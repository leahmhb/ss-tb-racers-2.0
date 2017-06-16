<form id="horse-filter" class="form-horizontal" method="post" action="/horse-table">
 <aside class="row">
  <div class="col-sm-12">
    <div class="panel panel-default">
      <div class="panel-heading"><h3 class="panel-title">Filter</h3></div>
      <div class="panel-body">

      <div class="col-sm-6">
        <div class="form-group">
          <label for="owner" class="col-sm-2 control-label">Owner</label>
          <div class="col-sm-10">       
            <select name="owner" class="form-control" id="owner">                 
              <option @if($owner == '0') selected @endif value="0">All</option>        
              @foreach ($domain['person'] as $p)          
              <option @if($owner == $p['id']) selected @endif value="{{$p['id']}}">{{$p['username']}}</option>
              @endforeach         
            </select>
          </div>                
        </div>
      </div>

      <div class="col-sm-6">
       <div class="form-group">
        <label for="grade" class="col-sm-2 control-label">Breeding Status</label>
        <div class="col-sm-10">
          <select name="breeding_status" class="form-control" id="breeding_status">              
            <option @if( $breeding_status == '0') selected @endif value="0">All</option>
            @foreach ($domain['breeding_status'] as $bs) 
            <option value="{{$bs['id']}}" @if($breeding_status == $bs['id']) selected @endif>
             {{ $bs['value'] }}
           </option>         
           @endforeach
         </select>
       </div>
     </div>
   </div>

   <div class="col-sm-6">
     <div class="form-group">
       <label for="sex" class="col-sm-2 control-label">Sex</label>
       <div class="col-sm-10">
        <select name="sex" class="form-control" id="sex">          
          <option @if( $sex == '0') selected @endif value="0">All</option>
          @foreach ($domain['sexes'] as $s)          
          <option @if( $sex == $s['id']) selected @endif value="{{$s['id']}}">{{$s['value']}}</option>
          @endforeach
        </select>           
      </div>        
    </div>

  </div>

  <div class="col-sm-6">

    <div class="form-group">
      <label for="grade" class="col-sm-2 control-label">Grade</label>
      <div class="col-sm-10">
       <select name="grade" class="form-control" id="grade">         
          <option @if( $grade == '0') selected @endif value="0">All</option>
         @foreach ($domain['grades'] as $g)
         <option value="{{$g['id']}}" @if($grade == $g['id']) selected @endif>
          {{$g['description']}}
        </option>           
        @endforeach
      </select>
    </div>
  </div>

</div>



</div>    
<div class="panel-footer">
  <div class="text-right"> 

    <button id="t_horse_filter_reset" type="reset" class="btn btn-default btn-sm">Reset</button> 
    <button type="submit" class="btn btn-primary btn-sm">Save</button>     

  </div>
</div>

</div> 
</div>
</aside>
</form>