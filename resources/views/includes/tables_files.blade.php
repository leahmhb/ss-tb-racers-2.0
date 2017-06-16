<link href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<link href="//cdn.datatables.net/plug-ins/1.10.11/integration/font-awesome/dataTables.fontAwesome.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>

<script>
 $(document).ready(function () {
   /*******DATA TABLE******/
   $.extend( $.fn.dataTable.defaults, {
    "pagingType": "simple",  
    "pageLength": 25,
    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],

  });

   $('#t_stall_entries').DataTable({
    "pageLength": 10,

  });

   $('#t_stall_ancestors, #t_stall_ancestors').DataTable({
    "pageLength": 10,
    "searching":false,
    "paging":false

  });

   $('#t_races, #t_horses, #t_lineages, #t_entries').DataTable();

   $('#t_users, #t_person').DataTable({
    "paging":false,
    "searching":false
  });


   /******* FILTER RESETS ******/
   $("#t_entry_filter_reset").on('click', function(){
    window.location.replace("/entry-table");
  });

   $("#t_race_filter_reset").on('click', function(){
    window.location.replace("/race-table");
  });

   $("#t_horse_filter_reset").on('click', function(){

    window.location.replace("/horse-table");
  });

   $("#t_lineage_filter_reset").on('click', function(){
    window.location.replace("/lineage-table");
  });

     /******* CHOSEN ******/
  $( "select" ).addClass( "select" );

  $(".select").chosen({
    width: "100%",
    placeholder_text_single: "Select...",
    no_results_text: "Oops, nothing found!",
    disable_search_threshold: 5,
    allow_single_deselect: true,
    search_contains: true
  });

});//end ready

</script>

