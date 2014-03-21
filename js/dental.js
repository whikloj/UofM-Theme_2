(function(){
  jQuery(document).ready(function(){
    jQuery('.uofm-dental-info h2').click(function(){ jQuery(this).next('table').toggle(function(){ var tmpT = (jQuery(this).is(':visible') ? 'hide' : 'show'); jQuery(this).prev('h2').text('Information (' + tmpT + ')'); });});
  });
})();