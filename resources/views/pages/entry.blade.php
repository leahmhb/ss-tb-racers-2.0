@extends('layouts.master', ['title' => 'Entry'])

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="panel-title">
            Entry Information
            @if($entry['id'])
            <a class="icon-link pull-right" href="{{ URL::route('remove_entry', $entry['id']) }}">
             <i class="fa fa-trash-o text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Remove"></i>
           </a>
           @endif
         </h1>
       </div>
       <div class="panel-body">
         @include('includes.form_validation_results')
         <form id="entry" class="form-horizontal" method="post">
          @include('forms.entry')
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
