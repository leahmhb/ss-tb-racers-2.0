@extends('layouts.master', ['title' => 'Entry Removal Confirmation'])
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
       <div class="panel-heading">
         <h1 class="panel-title">Entry Removal Confirmation</h1>
       </div>
       <div class="panel-body">      
        <h2>Are you sure you want to delete {{ $entry['horse']['call_name'] }}'s entry in {{ $entry['race']['name'] }}?</h2>        
      </div>
      <div class="panel-footer">
        <form class="text-right" method="post" action="/remove-entry/{{ $entry['id'] }}">
          <a role="button" class="btn btn-default" href="{{ URL::route('entry_table') }}">No, take me back to Entry Table</a>
          <button type="submit" class="btn btn-danger" name="yes">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection