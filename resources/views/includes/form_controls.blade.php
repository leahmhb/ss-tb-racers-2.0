 <div class="panel-footer">
  <div class="text-center"> 
    @if (!Auth::guest())
    <button type="reset" class="btn btn-default">Reset</button>     
    <button type="submit" class="btn btn-primary">Save</button>     
    @endif
  </div>
</div>
