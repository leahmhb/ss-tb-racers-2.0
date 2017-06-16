@extends('layouts.master', ['title' => 'Race Removal Confirmation'])
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
       <div class="panel-heading">
        <h1 class="panel-title">Race Removal Confirmation</h1>
      </div>
      <div class="panel-body">      
        <h2>Are you sure you want to delete {{ $race['name'] }} ?</h2>
        @if($entries)
        <ul>
          <li>This race has entries.</li>
          <li>This race cannot be deleted.</li>
          <li>If this race is a duplicate with entries, contact Haubing for manual deletion.</li>
        </ul>
        @endif      
      </div>
      <div class="panel-footer">
        <form class="text-right" method="post" action="/remove-race/{{ $race['id'] }}">
          @if($entries)
          <a role="button" class="btn btn-default" href="{{ URL::route('race_table') }}">OK, take me back to Race Table</a>
          @else
          <a role="button" class="btn btn-default" href="{{ URL::route('race_table') }}">No, take me back to Race Table</a>
          <button type="submit" class="btn btn-danger" name="yes">Yes</button>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection