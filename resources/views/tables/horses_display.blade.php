@extends('layouts.master', ['title' => 'Horses Table'])


@section('content')
<div class="container-fluid">
  @include('forms.t_horse_filter')
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">
          Horses
        </h3>
      </div><!--end heading-->
      <div class="panel-body">
       @include('tables.horses_table')
     </div><!--end panel content-->    
   </div><!--end panel--> 
 </div><!--end col-->
</div><!--end row-->
</div><!--end container-->
@endsection

@section('page-script')
@include('includes.tables_files')
@endsection