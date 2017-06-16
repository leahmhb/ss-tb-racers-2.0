@extends('layouts.master', ['title' => $title])

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1 class="panel-title">
            {{ $title }}'s Information             
          </h1>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12">          
              @include('includes.form_validation_results')
            </div>
          </div>
          <form id="user" class="form-horizontal" method="post">  
            @include('forms.user')   
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
