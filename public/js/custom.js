$(document).ready(function () {
  /*******DROP DOWN******/
  $('.dropdown-toggle').click(function() {
    var location = $(this).attr('href');
    window.location.href = location;
    return false;
  });

  $(".dropdown-toggle").dropdown();

  /*******TOOL TIPS******/
  $('[data-toggle="tooltip"]').tooltip();

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
});

