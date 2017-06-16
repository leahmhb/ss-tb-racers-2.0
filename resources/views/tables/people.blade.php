  @extends('layouts.master', ['title' => 'People Tables'])
  @section('content')
  <div class="container-fluid">

   <div class="row">
    <div class="col-sm-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            Person
          </h3>
        </div><!--end heading-->
        <div class="panel-body">
          <div class="table-responsive">

            <table id="t_person" class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th><small>Stable</small><br>Name</th>
                  <th><small>Stable</small><br>Prefix</th>
                  <th><small>Racing</small><br>Colors</th>            
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($person as $p)        
                <tr>
                  <td>@if($p['user_id']) {{$p['user_id']}} @else N @endif</td>
                  <td>{{$p['username']}}</td>
                  <td>
                    <a href="{{ URL::route('stable', $p['id']) }}">
                      <small>{{$p['stable_name']}}</small>
                    </a>
                  </td>
                  <td>{{$p['stable_prefix']}}</td>
                  <td><small>{{$p['racing_colors']}}</small></td>            
                  <td class="td_right nowrap_cell">    
                   @if($pl == 'true')  
                   <a class="icon-link" href="{{ URL::route('person', $p['id']) }}" title="Edit">
                     <i class="fa fa-pencil text-info" aria-hidden="true"  data-toggle="tooltip"></i>
                   </a> 
                   <a class="icon-link" href="{{ URL::route('remove_person', $p['id']) }}" title="Delete">
                    <i class="fa fa-trash-o text-danger" aria-hidden="true" data-toggle="tooltip"></i>
                  </a>    
                  @endif
                </td>
              </tr>
              @endforeach   
            </tbody>
          </table>
        </div><!--end table responsive-->
      </div><!--end panel body-->    
    </div><!--end panel--> 
  </div><!--end col-->
  <div class="col-sm-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          Users
        </h3>
      </div><!--end heading-->
      <div class="panel-body">
        <div class="table-responsive">
         <table id="t_users" class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $i=>$u)     
            <tr>
             <td>{{ $u['id'] }} </td>
             <td>{{ $u['name'] }} </td>   
             <td class="td_right nowrap_cell">
               @if($pl == 'true')  
               <a class="icon-link" href="{{ URL::route('user', $u['id']) }}">
                 <i class="fa fa-pencil text-info" aria-hidden="true" data-toggle="tooltip"></i>
               </a>
               @endif
             </td>         
           </tr>         
           @endforeach
         </tbody>
       </table>
     </div><!--end table responsive-->
   </div><!--end panel body-->    
 </div><!--end panel--> 
</div><!--end col-->
</div><!--end row-->
</div><!--end container-->
@endsection
@section('page-script')
@include('includes.tables_files')
@endsection