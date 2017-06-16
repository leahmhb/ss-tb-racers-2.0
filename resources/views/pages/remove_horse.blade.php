@extends('layouts.master', ['title' => 'Horse Removal Confirmation'])
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
       <div class="panel-heading">
        <h1 class="panel-title">Horse Removal Confirmation</h1>
      </div>
      <div class="panel-body">      
        <h2>Are you sure you want to delete {{ $horse['call_name'] }}?</h2>
        @if($lineages or $entries)
        <ul>
          @if($entries)
          <li>This horse has race entries.</li>
          @endif     
          @if($lineages)
          <li>This horse has lineage records.</li> 
          @endif          
          <li>This horse cannot be deleted.</li>
          <li>If you are absolutely sure you want to delete this horse, contact Haubing for maunal deletion.</li>
        </ul>
        @endif
      </div>
      <div class="panel-footer">
        <form class="text-right" method="post" action="/remove-horse/{{ $horse['id'] }}">
         @if($entries or $lineages)
         <a role="button" class="btn btn-default" href="{{ URL::route('horse_table') }}">OK, take me back to Horse Table</a>
         @else
         <a role="button" class="btn btn-default" href="{{ URL::route('horse_table') }}">No, take me back to Horse Table</a>
         <button type="submit" class="btn btn-danger" name="yes">Yes</button>
         @endif
       </form>
     </div>
   </div>
 </div>
</div>
@endsection