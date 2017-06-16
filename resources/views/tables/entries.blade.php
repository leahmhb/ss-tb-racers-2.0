@extends('layouts.master', ['title' => 'Entries Table'])

@section('content')
<div class="container-fluid">
  @include('forms.t_entry_filter')
  <div class="row">
    <div class="col-sm-12"> 
      <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">
          Entries
        </h3>
      </div><!--end heading-->
      <div class="panel-body">
       <div class="table-responsive">
         <table id="t_entries" class="table table-hover">
          <thead>
            <tr>
             <th>Placing</th>
             <th>Horse</th>
             <th>Series</th>
             <th>Race Distance Surface</th>  
             <th>Grade</th>
             <th>Note.<br>Win</th>    
             <th>Tra.<br>Rec.</th> 
             <th>Time</th>  
             <th>Ran<br>Date</th>  
             <th></th>
           </tr>
         </thead>
         <tbody>  
          @foreach($entries as $p=>$e)      
          <tr>
            <td>
              @if($e['placing'] != 0) 
              {{ $e['placing'] }} 
              @else 
              TBA 
              @endif
            </td>  
            <td>
             <a class="icon-link" href="{{ URL::route('stall', $e['horse_id']) }}">{{ $e['horse_name'] }}</a>
             @if($e['stall_path'])
             <a class="icon-link" href="{{$e['stall_path']}}" target="_blank" title="URL">
               <i class="fa fa-external-link text-default" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="URL"></i>
             </a>
             @endif
           </td> 
           <td>{{ $e['race_series'] }}</td>
           <td>
             <a href="{{ $e['url'] }}" target="_blank"> 
               {{ $e['race_name'] }} 
               {{ $e['race_distance'] }}F
               <i class="fa fa-circle @if( $e['race_surface']  == 'Turf')fa-green @else fa-brown @endif fa-lg" aria-hidden="true"  data-toggle="tooltip" data-placement="top" title="{{ $e['race_surface'] }}"></i>               
             </a>              
           </td>
<td>{{ $e['race_grade'] }} </td>
          <td>
       <i class="fa  
       @if($e['isNotableWin'] == 'YES')
       fa-check-square-o fa-green 
       @else 
       fa-square-o fa-color 
       @endif" aria-hidden="true"></i>     
     </td>
     <td>       
       <i class="fa 
       @if($e['isTrackRecord'] == 'YES')
       fa-check-square-o fa-green 
       @else 
       fa-square-o fa-color 
       @endif" aria-hidden="true"></i>       
     </td>
           <td> {{ $e['time'] }} </td>
           <td class="nowrap_cell">
             @if(date('Y-m-d', strtotime($e['race_randt'])) == '1000-01-01') 
             TBA
             @elseif(date('Y-m-d', strtotime($e['race_randt'])) == '1111-11-11')
             Unknown
             @else 
             {{ date('Y-m-d', strtotime($e['race_randt']))}} 
             @endif
           </td> 
           <td class="td_right nowrap_cell">    
            @if($e['user_pl'] == 'true')     
            <a class="icon-link" href="{{ URL::route('entry', [$e['horse_id'], $e['id'] ]) }}" title="Edit"> 
              <i class="fa fa-pencil text-info" aria-hidden="true"></i>
            </a>
            <a class="icon-link" href="{{ URL::route('remove_entry', $e['id']) }}" title="Delete">
              <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
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