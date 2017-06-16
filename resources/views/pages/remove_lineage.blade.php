@extends('layouts.master', ['title' => 'Lineage Removal Confirmation'])
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
       <div class="panel-heading">
        <h1 class="panel-title">Lineage Removal Confirmation</h1>
      </div>
      <div class="panel-body">      
        <h2>Are you sure you want to delete {{ $horse['call_name'] }}'s lineage ?</h2>
        @if($lineages)
        <ul>
          <li>This horse has offspring.</li> 
          <li>This horse cannot be deleted.</li>
          <li>If you are absolutely sure you want to delete this record, contact Haubing for manual deletion.</li>
        </ul>
        @endif     
      </div>
      <div class="panel-footer">
        <form class="text-right" method="post" action="/remove-lineage/{{ $horse['id'] }}">
          @if($lineages)
          <a role="button" class="btn btn-default" href="{{ URL::route('lineage_table') }}">OK, take me back to Lineage Table</a>
          @else
          <a role="button" class="btn btn-default" href="{{ URL::route('lineage_table') }}">No, take me back to Lineage Table</a>
          <button type="submit" class="btn btn-danger" name="yes">Yes</button>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection