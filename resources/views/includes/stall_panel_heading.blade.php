<h1 class="panel-title">   
 <span class="pull-left">
 <a class="icon-link" href="{{ URL::route('horse', [$horse['id'], '']) }}">
   <i class='fa-gray fa fa-paperclip' data-toggle="tooltip" data-placement="top" title="Edit Horse Info"></i>
 </a>
 </span>
 
 {{ $horse['call_name'] }}

 @if($horse['hexer']['stable_prefix'] != '' and $horse['registered_name'])
 <span class="text-muted small">{{ $horse['hexer']['stable_prefix'] }}'s' {{ $horse['registered_name'] }}</span> 
 @endif

 @if($horse['sex'] == 'Mare')
 <i class="fa-pink fa fa-venus"></i>
 @elseif($horse['sex'] == 'Stallion')
 <i class="fa-blue fa fa-mars"></i>
 @else
 <i class="fa-color fa fa-neuter"></i>
 @endif

 <span class="pull-right">
  @if($horse['breeding_status'] == 'Unavailable')
  <i class="fa fa-heart-o fa-lg text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Unavailable"></i>
  @elseif(   $horse['breeding_status']  == 'Available')
  <i class="fa fa-heart fa-lg text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Available"></i>
  @else 
  <i class="fa fa-heartbeat text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Available with Permission"></i>
  @endif
</span>
</h1>