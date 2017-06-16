@extends('layouts.master', ['title' => 'Welcome'])
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading"><h1 class="panel-title">Seeing Stars Thoroughbred Racers</h1></div>
        <div class="panel-body">      
          <h2>Welcome @if (!Auth::guest()): {{ Auth::user()->name }} @endif</h2>
          <div class="well">
            <h2 class="updates"><small>Updates</small></h2>
            <ul>         
            <li><b>14Jun16:</b> Added placings graph to stall pages.</li>
              <li><b>7Jun16:</b> Added icons to stall entries table. Slowly working on adding graphs to the stall pages to visualize win ratios of each horse.</li>
              <li><b>28May16:</b> Started stable pages. Stall pages now show extended ancestory and descendents.</li>
              <li><b>17May16:</b> Finished adding new fields to races and entries.</li>
              <li><b>11May16:</b> Down for development! Adding new features.</li>
              <li><b>9May16:</b> Race filters are finished. Stalls now show race entries in a data table for easier sorting/searchiing. </li>
              <li><b>30Apr16:</b> Banner background image by Fearow<i class="fa fa-heart" aria-hidden="true"></i>Added delete option on forms.</li>
              <li><b>21Apr16:</b> Table filters are work in progress. </li>
              <li><b>19Apr16:</b> Back up and running :]</li>
              <li><b>16Apr16:</b> DOWN FOR MAINTANCE. Reworking database.</li>
              <li><b>13Apr16:</b> Added Neco's racing guides with her permission.</li>
              <li><b>13Apr16:</b> Added users and lineages lists. User permissions changed.</li>
              <li><b>12Apr16:</b> Begining implmentation of users. Beware development bugs! On-going website construction.</li>
            </ul>				
          </div>
          <h2>Featured Horse</h2>
          <img class="stall-pic img-responsive" src="{{ asset('img/welcome-horse.png') }}" alt="featured horse Sovenance"> 
          <div class="well">
            Did your horse win a celebrated race? Want to show off your horse? Submit your horse to be featured on the front page. 
            Submissions must include both an edited photo of your horse and a short bio/description of achievement.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection