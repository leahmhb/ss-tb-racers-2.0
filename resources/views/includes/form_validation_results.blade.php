 <div id="success">
  @if($validate == true)
  <div class="alert alert-success @if($validate != true) hide @endif" role="alert">
    Success!
  </div>
  @endif
</div>
<div id="rsvErrors" class="alert alert-danger"></div>