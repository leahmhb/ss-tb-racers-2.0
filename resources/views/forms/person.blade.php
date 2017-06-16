<input name="id" class="form-control hidden" readonly id="id" value="{{ $person['id'] }}"> 

<div class="form-group">                    
  <label for="username" class="col-sm-2 control-label">
    <small>
      <i class="text-danger fa fa-asterisk" data-toggle="tooltip" data-placement="top" title="Required"></i>
    </small>
    Name
  </label>
  <div class="col-sm-10">
    <input name="username" class="form-control" id="username" value="{{ $person['username'] }}" placeholder="..." />              
  </div>             
</div>     

<div class="form-group">  
 <label for="stable_name" class="col-sm-2 control-label">   
  <small>
   <i class="text-info fa fa-star-o" data-toggle="tooltip" data-placement="top" title="Recommended"></i>
 </small> 
 Stable Name
</label>
<div class="col-sm-10">       
 <input name="stable_name" class="form-control" id="stable_name" value="{{ $person['stable_name'] }}" placeholder="..." />
</div>             
</div> 

<div class="form-group">
 <label for="stable_prefix" class="col-sm-2 control-label">   
   <small>
     <i class="text-info fa fa-star-o" data-toggle="tooltip" data-placement="top" title="Recommended"></i>
   </small>      
   Stable Prefix
 </label>
 <div class="col-sm-10"> 
  <input name="stable_prefix" class="form-control" id="stable_prefix" value="{{ $person['stable_prefix'] }}" placeholder="..." />   
</div>             
</div> 

<div class="form-group">
 <label for="racing_colors" class="col-sm-2 control-label">     
   <small>
     <i class="text-info fa fa-star-o" data-toggle="tooltip" data-placement="top" title="Recommended"></i>
   </small>             
   Racing Colors
 </label>
 <div class="col-sm-10"> 
  <input name="racing_colors" class="form-control" id="racing_colors" value="{{ $person['racing_colors'] }}" placeholder="..." />   
</div>             
</div> 
