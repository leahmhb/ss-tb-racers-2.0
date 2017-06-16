@extends('layouts.master', ['title' => 'Guide: Entry Form'])

@section('content') 
<div class="container-fluid">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">    
      <form id="demo" class="form-horizontal" method="post" action="/guide_form">  
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">
              Racing Entry Form 
            </h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">          
                <div id="rsvErrors" class="alert alert-danger"></div>
              </div>
            </div>
            @include('forms.demo_entry')
          </div> 
          <div class="panel-footer">
            <div class="text-center"> 
             <button class="btn btn-default" type="reset">Clear</button>
             <button class="btn btn-primary" type="submit">Create</button>
           </div>
         </div>   
       </div>   
     </form>
   </div>
 </div>
</div>
@endsection

@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<script src="{{ asset('js/forms.js') }}"></script>
@endsection
