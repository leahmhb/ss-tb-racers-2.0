@extends('layouts.master', ['title' => 'Person Removal Confirmation'])
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
       <div class="panel-heading">
        <h1 class="panel-title">
          Person Removal Confirmation          
        </h1>
      </div>
      <div class="panel-body">      
        <h2>Are you sure you want to delete {{ $person['username'] }} ?</h2>
        @if($horses)
        This person owns the following horses:
        <ul>
          @foreach($horses as $h)
          <li>{{ $h['call_name'] }}</li>
          @endforeach
        </ul>
        This person cannot be deleted.
        @endif      
      </div>
      <div class="panel-footer">
        <form class="text-right" method="post" action="/remove-person/{{ $person['id'] }}">
          @if($horses)
          <a role="button" class="btn btn-default" href="{{ URL::route('people_tables') }}">OK, take me back to People Tables</a>
          @else
          <a role="button" class="btn btn-default" href="{{ URL::route('people_tables') }}">No, take me back to People Tables</a>
          <button type="submit" class="btn btn-danger" name="yes">Yes</button>
          @endif          
        </form>
      </div>
    </div>
  </div>
</div>
@endsection