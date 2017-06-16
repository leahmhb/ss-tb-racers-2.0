@extends('layouts.master', ['title' => 'Lineage'])
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="panel-title">
            Lineage Information     
            <a class="icon-link pull-right" href="{{ URL::route('remove_lineage', $lineage['horse']['id']) }}">
             <i class="fa fa-trash-o text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Remove"></i>
           </a>   
         </h1>
       </div>
       <div class="panel-body">
        <div class="row">
          <div class="col-sm-12">          
            @include('includes.form_validation_results')
          </div>
        </div>
        <form id="lineage" class="form-horizontal" method="post">  
          @include('forms.lineage')  
        </div>
        @include('includes.form_controls')
      </form>
    </div>
  </div>
</div>
</div>
@endsection

@section('page-script')
@include('includes.form_files')
@endsection
