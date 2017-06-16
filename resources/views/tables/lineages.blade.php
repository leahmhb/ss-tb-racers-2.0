@extends('layouts.master', ['title' => 'Lineages Table'])

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">
          Lineages
        </h3>
      </div><!--end heading-->
      <div class="panel-body">

       <div class="table-responsive">

         <table id="t_lineages" class="table table-hover">
          <thead>
            <tr>
             <th>Generation</th>
             <th>Horse</th>
             <th>Sire</th>
             <th>Dam</th>
             <th class="col-sm-1"></th>
           </tr>
         </thead>
         <tbody>
          @foreach($lineage as $i=>$l)
          <tr>
            <td> {{ $l['generation'] }} </td>
            <td>
             <a class="icon-link" href="{{ URL::route('stall', $l['id']) }}">
              {{ $l['horse_name'] }}
            </a>
            @if($l['horse_link'])
            <a class="icon-link" href="{{ $l['horse_link'] }}" title="URL">
              <i class="fa fa-external-link text-default" aria-hidden="true"></i>
            </a>
            @endif
          </td>
          <td>
           <a class="icon-link" href="{{ URL::route('stall', $l['sire_id']) }}">
             {{ $l['sire_name'] }}
           </a>
           @if($l['sire_link'])
           <a class="icon-link" href="{{ $l['sire_link'] }}" title="URL">
            <i class="fa fa-external-link text-default" aria-hidden="true"></i>
          </a>
          @endif
        </td>
        <td>
         <a class="icon-link" href="{{ URL::route('stall', $l['dam_id']) }}">
          {{ $l['dam_name'] }}
        </a>
        @if($l['dam_link'])
        <a class="icon-link" href="{{ $l['dam_link'] }}" title="URL">
          <i class="fa fa-external-link text-default" aria-hidden="true"></i>
        </a>
        @endif
      </td>
      <td class="td_right nowrap_cell">
       @if($l['user_pl'] == 'true')
       <a class="icon-link" href="{{ URL::route('lineage', [$l['id'], $l['id'] ]) }}" title="Edit">
        <i class="fa fa-pencil text-info" aria-hidden="true" data-toggle="tooltip"></i>
      </a>
      <a class="icon-link" href="{{ URL::route('remove_lineage', $l['id']) }}" title="Delete">
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