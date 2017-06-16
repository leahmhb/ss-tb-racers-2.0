<div class="table-responsive">
  <table id="t_stall_ancestors" class="table table-hover">
    <thead>
      <tr>
        <th><small>Call</small><br>Name</th>      
        <th>Sex</th>
        <th>Grade</th>
        <th><small>Breeding</small><br>Status</th>        
        <th>Sire</th>
        <th>Dam</th>
        <th>Owner</th> 
      </tr>
    </thead>
    <tbody>
      @foreach($tableData['descendents'] as $h)
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
        <td>{{$h['grade'] }} </td> 
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

        <td>
          <a class="icon-link" href="{{ URL::route('stall', $h['parents']['sire_id']) }}">
            {{$h['parents']['sire_name'] }}
          </a>
          @if($h['parents']['sire_link'])
          <a class="icon-link" href="{{$h['parents']['sire_link']}}" target="_blank" title="URL">
            <i class="fa fa-external-link text-default" aria-hidden="true"></i>
          </a>
          @endif
        </td>
        <td>
          <a class="icon-link" href="{{ URL::route('stall', $h['parents']['dam_id']) }}">
            {{$h['parents']['dam_name'] }}
          </a>
          @if($h['parents']['dam_link'])
          <a class="icon-link" href="{{$h['parents']['dam_link']}}" target="_blank" title="URL">
            <i class="fa fa-external-link text-default" aria-hidden="true"></i>
          </a>
          @endif
        </td>          
        <td>{{$h['owner']}}</td> 
      </tr>
      @endforeach   
    </tbody>
  </table>
</div><!--end table responsive--> 