<div class="table-responsive">
 <table id="t_stall_entries" class="table table-hover">
  <thead>
    <tr>
     <th>Placing</th> 
     <th>Note. Win</th>    
     <th>Tra. Rec.</th> 
     <th>Time</th>       
     <th>Series</th>
     <th>Race</th>
     <th>Dist.</th>
     <th>Surf.</th>          
     <th>Grade</th> 
     <th>Ran Date</th>         
     <th></th>
   </tr>
 </thead>
 <tbody>  
   @foreach($tableData['race_records'] as $r)
   <tr>
     <td>{{ $r['placing'] }}</td>  
     <td>
       <i class="fa  
       @if($r['isNotableWin'] == 'YES')
       fa-check-square-o fa-green 
       @else 
       fa-square-o fa-color 
       @endif" aria-hidden="true"></i>     
     </td>
     <td>       
       <i class="fa 
       @if($r['isTrackRecord'] == 'YES')
       fa-check-square-o fa-green 
       @else 
       fa-square-o fa-color 
       @endif" aria-hidden="true"></i>       
     </td>
     <td>{{ $r['time'] }}</td>

     <td>
    {{ $r['series'] }}
     </td>
     <td>
       <a class="icon-link" href="{{ $r['url'] }}" target="_blank">
         {{ $r['name'] }}
       </a>
     </td>
     <td>{{ $r['distance'] }}F</td>
     <td>          
       <i class="fa fa-circle @if( $r['surface']  == 'Turf')fa-green @else fa-brown @endif fa-lg" aria-hidden="true"  data-toggle="tooltip" data-placement="top" title="{{ $r['surface'] }}"></i>
     </td>          
     <td>{{ $r['grade'] }}</td> 
     <td class="date_row">

      @if(date('Y-m-d', strtotime($r['ran_dt'])) == '1000-01-01') 
      TBA
      @elseif(date('Y-m-d', strtotime($r['ran_dt'])) == '1111-11-11')
      Unknown
      @else 
      {{ date('Y-m-d', strtotime($r['ran_dt']))}}    
      @endif       
    </td>         
    <td> 
      @if($r['user_pl'] == 'true')     
      <a class="icon-link" href="{{ URL::route('entry', [$horse['id'], $r['entry_id']]) }}">
        <i class='fa-gray fa fa-pencil'  data-toggle="tooltip" data-placement="top" title="Edit"></i>
      </a>  
      @endif
    </td>
  </tr>         
  @endforeach

</tbody>
</table>
</div><!--end table responsive-->