@extends('layouts.master', ['title' => 'Stable: ' . $person["stable_name"] ])

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">

      <div class="panel panel-default">
       <div class="panel-heading text-center">@include('includes.stable_panel_heading')</div>
       <div class="panel-body"> 
         <h2>Statistics and Charts <small>Only as accurate as the information added about your horses.</small></h2>
         <div class="row">
           <div class="col-sm-6"><div id="placingsChart"></div></div>
           <div class="col-sm-6"><div id="gradesChart"></div></div>
         </div>
       </div>  
     </div>


     <div class="panel panel-default">
       <div class="panel-heading text-center">@include('includes.stable_panel_heading')</div>
       <div class="panel-body"> 
        <h2>Horses of {{ $person["stable_name"] }}</h2>
        @include('tables.horses_table')
      </div>
    </div>
  </div>
</div>
</div>

@endsection

@section('page-script')
@include('includes.tables_files')
@include('includes.chart_files')
<script>
  var charts = [];
  $(document).ready(function () {
    donutChart('#placingsChart', {!! $placingsData !!}, 'Placings' );
    donutChart('#gradesChart', {!! $gradesData !!}, 'Grades' );
  });
</script>
@endsection