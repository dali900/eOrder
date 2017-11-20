  
// Add slideUp animation to Bootstrap dropdown when collapsing.
  $('.dropdown').on('show.bs.dropdown', function() {
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown("fast");
  });

  
  $('.dropdown').on('hide.bs.dropdown', function() {
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp("fast");
  });


 


