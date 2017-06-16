        <div class="table-responsive">
         <table id="t_horses" class="table table-hover">
          <thead>
            <tr>
              <th><small>Call</small><br>Name</th>      
              <th>Sex</th>
              <th><small>Breeding</small><br>Status</th>
              <th>Grade</th>
              <th>Abilities</th>
              <th><span class="fa-brown">Dirt</span>/<span class="fa-green">Turf</span></th>
              <th>Distance</th>
              <th>Max Stat</th>
              @if($type != 'stable') 
              <th>Owner</th>  
              @endif            
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($horses as $h)
            <tr>
              <td>
                <a class="icon-link" href="{{ URL::route('stall', $h['id']) }}">
                  {{$h['call_name']}}
                </a> 
                @if($h['stall_path'])
                <a class="icon-link" href="{{$h['stall_path']}}" target="_blank" title="URL">
                  <i class="fa fa-external-link text-default" aria-hidden="true"></i>
                </a>
                @endif
              </td> 
              <td>
                <i class="
                fa fa-lg
                @if($h['sex'] == 'Mare')
                fa-pink fa-venus
                @elseif($h['sex'] == 'Stallion')
                fa-blue fa-mars
                @elseif($h['sex'] == 'Gelding')
                fa-color fa-neuter
                @endif
                " data-toggle="tooltip" data-placement="top" title="{{ $h['sex'] }}"></i>    
                <span class="sr-only">{{ $h['sex'] }}</span>          
              </td>
              <td>
               <i class="
               fa fa-lg text-danger fa-lg 
               @if($h['breeding_status'] == 'Unavailable')
               fa-heart-o 
               @elseif($h['breeding_status']  == 'Available')
               fa-heart
               @elseif($h['breeding_status']  == 'Available with Permission') 
               fa-heartbeat
               @endif
               " aria-hidden="true" data-toggle="tooltip" data-placement="top" title="{{ $h['breeding_status'] }}"></i>
               <span class="sr-only">{{ $h['breeding_status'] }}</span>    
             </td>
             <td>{{$h['grade'] }} </td> 
             <td>
               <small><i class="fa fa-plus text-success"></i> {{$h['pos_ability_1']}}</small><br>
               <small><i class="fa fa-plus text-success"></i> {{$h['pos_ability_2']}}</small><br>
               <small><i class="fa fa-minus text-danger"></i> {{$h['neg_ability_1']}}</small>
             </td>
             <td>
               <i class="
               fa fa-brown fa-lg
               @if($h['surface_dirt'] == 'Great')
               fa-circle 
               @elseif($h['surface_dirt'] == 'Good')
               fa-dot-circle-o
               @elseif($h['surface_dirt'] == 'Okay')
               fa-circle-o
               @endif
               " aria-hidden="true"  data-toggle="tooltip" data-placement="top" title="{{ $h['surface_dirt'] }}"></i>
               <span class="sr-only">Dirt: {{ $h['surface_dirt'] }}</span>    
               <i class="
               fa fa-green fa-lg
               @if($h['surface_turf'] == 'Great')
               fa-circle 
               @elseif($h['surface_turf'] == 'Good')
               fa-dot-circle-o
               @elseif($h['surface_turf'] == 'Okay')
               fa-circle-o
               @endif
               " aria-hidden="true"  data-toggle="tooltip" data-placement="top" title="{{ $h['surface_turf'] }}"></i>    
               <span class="sr-only">Turf: {{ $h['surface_turf'] }}</span>         
             </td>
             <td class="nowrap_cell"> 
               {{ $h['distance_min'] }} - {{ $h['distance_max'] }}F
             </td>
             <td>
               <span class="text-capitalize">{{ $h['max_stat'] }}</span>
             </td>
             @if($type != 'stable') 
             <td>{{$h['owner']}}</td> 
             @endif
             <td class="td_right nowrap_cell">  
              @if($h['user_pl'] == 'true')
              <a class="icon-link" href="{{ URL::route('horse', $h['id']) }}">
               <i class="fa fa-pencil text-info" aria-hidden="true" data-toggle="tooltip" title="Edit"></i>
             </a>
             <a class="icon-link" href="{{ URL::route('remove_horse', $h['id']) }}" title="Delete">
              <i class="fa fa-trash-o text-danger" aria-hidden="true" data-toggle="tooltip"></i>
            </a>       
            @endif
          </td>
        </tr>
        @endforeach   
      </tbody>
    </table>
  </div><!--end table responsive--> 