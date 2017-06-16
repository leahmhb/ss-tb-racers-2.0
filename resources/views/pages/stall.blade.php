@extends('layouts.master', ['title' => 'Stall: ' . $horse["call_name"] ])

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading text-center">@include('includes.stall_panel_heading')</div>
        <div class="panel-body">
          @if($horse['stall_img'])
          <img class="stall-pic img-responsive" src="{{ $horse['stall_img'] }}" alt="stall img">  
          @else
          <p class="text-center">No stall image.</p>
          @endif
        </div>
        <div class="panel-footer">
         <ul class="stall-info list-inline text-center"> 
           <li><a class="icon-link" href="{{ URL::route('lineage', [$horse['id'], $horse['id'] ]) }}">
             <i class='fa-gray fa fa-paperclip' data-toggle="tooltip" data-placement="top" title="Edit Lineage"></i>
           </a></li>
           @if($horse['parents']['sire_name'] and $horse['parents']['dam_name'])
           [{{ $horse['parents']['generation'] }} Gen]
           <li><b>Sire:</b> <a class="icon-link" href="{{$horse['parents']['sire_link']}}">{{ $horse['parents']['sire_name'] }}</a></li>
           <li><b>Dam:</b> <a class="icon-link" href="{{$horse['parents']['dam_link']}}">{{ $horse['parents']['dam_name'] }}</a></li>
           @else
           <li><b>Foundation {{ $horse['sex'] }}</b></li>
           @endif
         </ul>
       </div>
     </div>


     <div class="panel panel-default">
      <div class="panel-heading text-center">@include('includes.stall_panel_heading')</div>
      <div class="panel-body">
        <div class="row">      
          <div class="col-sm-3">
           <h2>           
             Info
           </h2>
           <ul>
            <li>
              <b>Owner:</b> {{ $horse['owner']['username'] }}
            </li>
            @if ($horse['breeder'])
            <li>
              <b>Breeder:</b> {{ $horse['breeder'] }}
            </li>
            @endif
            @if($horse['hexer']) 
            <li>
              <b>Hexer:</b> {{ $horse['hexer']['username'] }}
            </li>
            @endif    
            @if($horse['color']) 
            <li>
              <b>Color:</b> 
              {{ $horse['color'] }} 
              @if($horse['phenotype'])
              - {{ $horse['phenotype'] }}
              @endif        
            </li>
            @endif   
            <li>
              <b>Sex:</b> {{ $horse['sex'] }}
            </li>    
            <li>
              <b>Grade:</b> {{ $horse['grade'] }}
            </li>         
            <li>
              <b>Breeding Status:</b> 
              {{ $horse['breeding_status'] }}             
            </li>  
          </ul>
        </div>
        <div class="col-sm-9">
          <h2>Notes</h2>
          <textarea class="form-control" rows="16" readonly>{{ $horse['notes'] }}</textarea>
        </div>    
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading text-center">@include('includes.stall_panel_heading')</div>
    <div class="panel-body">   
      <div class="row">
       <div class="col-sm-12">
         <h2>           
           Racing Statistics
         </h2>
       </div>
       <div class="col-sm-3">
         <ul class="stall-info list-unstyled"> 
          <li><b>Speed:</b> {{ $horse['speed'] }} </li>
          <li><b>Staying:</b> {{ $horse['staying'] }} </li> 
          <li><b>Stamina:</b> {{ $horse['stamina'] }} </li> 
          <li><b>Breaking:</b> {{ $horse['breaking'] }} </li> 
          <li><b>Power:</b> {{ $horse['power'] }} </li> 
          <li><b>Feel:</b> {{ $horse['feel'] }} </li> 
          <li><b>Fierce:</b> {{ $horse['fierce'] }} </li> 
          <li><b>Tenacity:</b> {{ $horse['tenacity'] }} </li> 
          <li><b>Courage:</b> {{ $horse['courage'] }} </li> 
          <li><b>Response:</b> {{ $horse['response'] }} </li> 
          <li><b>Surface:</b>
            <ul class="stall-info list-unstyled">
              <li><b>Dirt-</b> 
                <span class="text-capitalize">{{ $horse['surface_dirt'] }}</span>
              </li>
              <li><b>Turf-</b> 
                <span class="text-capitalize">{{ $horse['surface_turf'] }}</span>
              </li>
            </ul>
          </li>      
          <li><b>Neck Height:</b> 
            <span class="text-capitalize">{{ $horse['neck_height'] }}</span>
          </li>
          <li><b>Run Style:</b> 
           <span class="text-capitalize">{{ $horse['run_style'] }}</span>
         </li>
         <li><b>Equipment:</b>
          <ul class="stall-info list-unstyled">
            <li><b>Bandages</b> 
              <span class="text-capitalize">{{ $horse['bandages'] }}</span>
            </li>
            <li><b>Hood</b> 
              <span class="text-capitalize">{{ $horse['hood'] }}</span>
            </li>
            <li><b>Shadow Roll</b>           
             <span class="text-capitalize">{{ $horse['shadow_roll'] }}</span>
           </li>
         </ul>
       </li>
     </ul> 
   </div>
   <div class="col-sm-5">
    <ul class="stall-info list-unstyled"> 
      <li><b>Distance:</b> {{ $horse['distance_min'] }}F to {{ $horse['distance_max'] }}F</li>
      <li>
        <b>Leg Type:</b> {{ $horse['leg_type']['value'] }}
        <ul class="stall-info list-unstyled">
          <li>{{ $horse['leg_type']['description'] }}</li>
        </ul>
      </li>
      <li>
        <b>Abilities:</b>
        <ul class="stall-info list-unstyled">
          @foreach($horse['abilities'] as $ability)
          <li>                 
            <b>@if($ability['type'] == 'positive') 
              <i class="fa fa-plus text-success"></i>
              @else 
              <i class="fa fa-minus text-danger"></i>
              @endif
            </b>
            <span class="text-default">{{ $ability['ability'] }}:</span> 
            {{ $ability['description'] }}
          </li>
          @endforeach              
        </ul>
      </li>       
    </ul>
  </div>
  <div class="col-sm-4">      
    <textarea class="form-control" rows="20" readonly>
      [b]+++Form[/b]
      [b]++Stats:[/b]
      [b]Speed:[/b] {{ $horse['speed'] }}
      [b]Staying:[/b] {{ $horse['staying'] }}
      [b]Stamina:[/b] {{ $horse['stamina'] }}
      [b]Breaking:[/b] {{ $horse['breaking'] }}
      [b]Power:[/b] {{ $horse['power'] }}
      [b]Feel:[/b] {{ $horse['feel'] }}
      [b]Fierce:[/b] {{ $horse['fierce'] }}
      [b]Tenacity:[/b] {{ $horse['tenacity'] }}
      [b]Courage:[/b] {{ $horse['courage'] }}
      [b]Response:[/b] {{ $horse['response'] }}
      [b]Distance:[/b] {{ $horse['distance_min'] }}F - {{ $horse['distance_max'] }}F
      [b]Leg Type:[/b] {{ $horse['leg_type']['value'] }}
      [b]Abilities:[/b][LIST]@foreach($horse['abilities'] as $ability) 
      [b]@if($ability['type'] == 'positive') + @else - @endif {{ $ability['ability'] }}:[/b] {{ $ability['description'] }} @endforeach[/LIST][b]Dirt:[/b] {{ $horse['surface_dirt'] }}
      [b]Turf:[/b] {{ $horse['surface_turf'] }}
      [b]++Horse Info[/b]
      [b]Name:[/b] {{ $horse['call_name'] }}
      [b]Color:[/b] {{ $horse['color'] }}
      [b]Gender:[/b] {{ $horse['sex'] }}
      [b]Bandages:[/b] {{ $horse['bandages'] }}
      [b]Neck Height:[/b] {{ $horse['neck_height'] }}
      [b]Run Style:[/b] {{ $horse['run_style'] }}
      [b]Hood:[/b] {{ $horse['hood'] }}
      [b]Shadow Roll:[/b] {{ $horse['shadow_roll'] }}
      [b]Farm/stable name:[/b] {{ $horse['owner']['stable_name'] }}
      [b]Racing Colors:[/b] {{ $horse['owner']['racing_colors'] }}
      [img]{{ $horse['racing_img'] }}[/img]</textarea> 
    </div>
  </div>
</div>
</div>

<div class="panel panel-default">
 <div class="panel-heading text-center">@include('includes.stall_panel_heading')</div>
 <div class="panel-body"> 
   <h2>Statistics and Charts <small>Only as accurate as the information added about {{ $horse['call_name'] }}.</small></h2>
   <div class="row">
     <div class="col-sm-6"><div id="placingsChart"></div></div>
   </div>
 </div>  
</div>

<div class="panel panel-default">
 <div class="panel-heading text-center">@include('includes.stall_panel_heading')</div>
 <div class="panel-body race-records-table-container"> 
  <div class="row">
    <div class="col-sm-12">
      <h2>       
        Race Records
        <small>
          <a class="icon-link" href="{{ URL::route('entry', [$horse['id']]) }}">
            <i class='fa-gray fa fa-plus-square-o'  data-toggle="tooltip" data-placement="top" title="Add Entry"></i>
          </a>
        </small>
      </h2>

    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      @include('tables.stall_entries') 
    </div>
  </div>
</div>
</div>

<div class="panel panel-default">
  <div class="panel-heading text-center">@include('includes.stall_panel_heading')</div>
  <div class="panel-body">   
    <div class="row">    
      <div class="col-sm-12">   
        <h2>
          Descendents
          <small>
            <a class="icon-link" href="{{ URL::route('lineage', [$horse['sex'], $horse['id'] ]) }}">
              <i class='fa-gray fa fa-plus-square-o'  data-toggle="tooltip" data-placement="top" title="Add Offspring"></i>
            </a>
          </small>  
        </h2>          

        @include('tables.stall_descendents') 
        <h2>
          Ancestors
        </h2>     
        @include('tables.stall_ancestors') 
      </div>
    </div>
  </div>
</div>

<div class="panel panel-default"> 
 <div class="panel-heading text-center">@include('includes.stall_panel_heading')</div>
 <div class="panel-body">
   @if($horse['racing_img'])
   <img class="stall-pic img-responsive" src="{{ $horse['racing_img'] }}" alt="racing img">
   @else
   <p class="text-center">No racing image.</p>
   @endif
 </div>
</div>

</div>
</div>
</div>

@endsection

@section('page-script')
@include('includes.chart_files')
@include('includes.tables_files')
<script>
  var charts = [];
  $(document).ready(function () {
    donutChart('#placingsChart', {!! $chartData['placings'] !!}, 'Placings' );

  });
</script>
@endsection