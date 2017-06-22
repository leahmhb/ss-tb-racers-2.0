@extends('layouts.master', ['title' => $title])

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="panel-title">
            {{ $title }}'s Information
            <a class="icon-link pull-right" href="{{ URL::route('remove_horse', $horse['id']) }}">
              <i class="fa fa-trash-o text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Remove"></i>
            </a>
          </h1>
        </div>
        <div class="panel-body">
          @include('includes.form_validation_results')
          <form id="horse" class="form-horizontal" method="post">
           <input type="text" readonly class="form-control hidden" name="id" id="id"  value="{{ $horse['id'] }}">
          <div class="row vdivide">
           <div class="col-sm-6">
             @include('forms.horse_info')
             @include('forms.lineage')
           </div>
           <div class="col-sm-6">
             @include('forms.horse_racing')
           </div>
         </div>
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
