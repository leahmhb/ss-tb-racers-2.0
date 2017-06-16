 @extends('layouts.master', ['title' => 'Guide: Entry Form'])

@section('content') 
<div class="container-fluid">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">    
      <form id="demo" class="form-horizontal" method="">  
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">
              Racing Entry Form 
            </h3>
          </div>
          <div class="panel-body">

 <textarea class="form-control" rows="32" readonly>
    [b]+++Form[/b]
    [b]++Stats:[/b]
    [b]Speed:[/b] {{ $data['speed'] }}
    [b]Staying:[/b] {{ $data['staying'] }}
    [b]Stamina:[/b] {{ $data['stamina'] }}
    [b]Breaking:[/b] {{ $data['breaking'] }}
    [b]Power:[/b] {{ $data['power'] }}
    [b]Feel:[/b] {{ $data['feel'] }}
    [b]Fierce:[/b] {{ $data['fierce'] }}
    [b]Tenacity:[/b] {{ $data['tenacity'] }}
    [b]Courage:[/b] {{ $data['courage'] }}
    [b]Response:[/b] {{ $data['response'] }}
    [b]Distance:[/b] {{ $data['distance_min'] }}F - {{ $data['distance_max'] }}F
    [b]Leg Type:[/b] {{ $data['leg_type'] }}
    [b]Abilities:[/b][LIST] 
    [b] + [/b]{{ $data['pos_ability_1'] }}
    [b] + [/b]{{ $data['pos_ability_2'] }}
    [b] - [/b]{{ $data['pos_ability_1'] }}[/LIST][b]Dirt:[/b] {{ $data['surface_dirt'] }}
    [b]Turf:[/b] {{ $data['surface_turf'] }}
    [b]++Horse Info[/b]
    [b]Name:[/b] {{ $data['call_name'] }}
    [b]Color:[/b] {{ $data['color'] }}
    [b]Gender:[/b] {{ $data['sex'] }}
    [b]Bandages:[/b] {{ $data['bandages'] }}
    [b]Neck Height:[/b] {{ $data['neck_height'] }}
    [b]Run Style:[/b] {{ $data['run_style'] }}
    [b]Hood:[/b] {{ $data['hood'] }}
    [b]Shadow Roll:[/b] {{ $data['shadow_roll'] }}
    [b]Farm/stable name:[/b] {{ $data['stable_name'] }}
    [b]Racing Colors:[/b] {{ $data['racing_colors'] }}
    [img]{{ $data['racing_img'] }}[/img]
  </textarea> 

   </div> 
         
     </div>   
   </form>
 </div>
</div>
</div>
@endsection
