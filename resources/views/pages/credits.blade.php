@extends('layouts.master', ['title' => 'Credits'])

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">     
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Resources</h3>
        </div>
        <div class="panel-body">
          <ul>
            <li><a href="http://getbootstrap.com/" target="_blank">Bootstrap</a>
              <ul>
                <li><a href="https://www.bootstrapcdn.com/" target="_blank">Bootstrap CDN</a></li>
                <li><a href="http://bootstrap-live-customizer.com/" target="_blank">Bootstrap Live Customizer</a></li>            
                <li><a href="http://bootswatch.com/" target="_blank">Bootswatch</a></li>
                <li><a href="https://bootstrap-datepicker.readthedocs.org/" target="_blank">Bootstrap-Datepicker</a></li>
              </ul>
            </li>
            <li><a href="https://jquery.com" target="_blank">jQuery</a> Plugins
              <ul>
               <li><a href="http://www.benjaminkeen.com/open-source-projects/smaller-projects/really-simple-validation-js/really-simple-validation-jquery-plugin/" target="_blank">RSV</a></li>
               <li><a href="https://harvesthq.github.io/chosen/" target="_blank">Chosen</a></li>
               <li><a href="https://datatables.net/" target="_blank">DataTables</a></li>
               <li><a href="http://c3js.org/" target="_blank">c3.js</a></li>
             </ul>
           </li>
           <li>Misc
            <ul>
             <li><a href="http://subtlepatterns.com" target="_blank">Subtle Patterns</a></li>
             <li><a href="https://fortawesome.github.io/" target="_blank">Font Awesome</a></li>
             <li><a href="https://cdnjs.com/" target="_blank">cdnjs</a></li>
             <li><a href="https://www.google.com/font" target="_blank">Google Fonts</a></li>
           </ul>
         </li>
       </ul>
     </div>    
   </div>
 </div>
</div>
</div>
@endsection