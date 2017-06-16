@extends('layouts.master', ['title' => 'Races Table'])

@section('content')
<div class="container-fluid">
  @include('forms.t_race_filter')
  <div class="row">
    <div class="col-sm-12">   
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            Races
          </h3>
        </div><!--end heading-->
        <div class="panel-body">

          <div class="table-responsive">
            <table id="t_races" class="table table-hover">
              <thead>
                <tr>
                  <th>Series</th>
                  <th>Name</th>
                  <th>Dist.</th>
                  <th>Sur.</th>          
                  <th>Gra.</th>   
                  <th>Time</th>
                  <th>Weath.</th>
                  <th>Cou.</th>
                  <th>Ran Date</th>            
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($races as $l=>$r)     
                <tr>
                  <td>{{ $r['series'] }} </td>          
                  <td>
                    @if($r['url'] != '')
                    <a class="icon-link" href="{{ $r['url'] }}" target="_blank"> 
                      {{ $r['name'] }} 
                    </a>
                    @else 
                    {{ $r['name'] }} 
                    @endif
                  </td>
                  <td>{{ $r['distance'] }}F</td>
                  <td>                       
                    <i class="fa fa-circle @if( $r['surface']  == 'Turf')fa-green @else fa-brown @endif fa-lg" aria-hidden="true"  data-toggle="tooltip" data-placement="top" title="{{ $r['surface'] }}"></i>             
                  </td>   
                  <td>{{ $r['grade'] }}</td>  
                  <td>{{ $r['final_time'] }}</td>
                  <td>{{ $r['weather'] }}</td>   
                  <td>{{ $r['course'] }}</td>      
                  <td class="date_row">
                    @if(date('Y-m-d', strtotime($r['ran_dt'])) == '1000-01-01') 
                    TBA
                    @elseif(date('Y-m-d', strtotime($r['ran_dt'])) == '1111-11-11')
                    Unknown
                    @else 
                    {{ date('Y-m-d', strtotime($r['ran_dt']))}}    
                    @endif       
                  </td>
                  <td class="td_right nowrap_cell">    
                  @if($r['user_pl'] == 'true')                      
                    <a class="icon-link" href="{{ URL::route('race', $r['id']) }}" title="Edit">
                      <i class="fa fa-pencil text-info" aria-hidden="true"  data-toggle="tooltip"></i>
                    </a>
                    <a class="icon-link" href="{{ URL::route('remove_race', $r['id']) }}" title="Delete">
                      <i class="fa fa-trash-o text-danger" aria-hidden="true" data-toggle="tooltip"></i>
                    </a> 
                    @endif                 
                  </td>
                </tr>         
                @endforeach
              </tbody>
            </table>
          </div><!--end table responsive-->
        </div><!--end panel content-->
      </div><!--end panel-->   
    </div><!--end col-->
  </div><!--end row-->
</div><!--end container-->
@endsection

@section('page-script')
@include('includes.tables_files')
@endsection