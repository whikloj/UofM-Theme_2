Drupal.behaviors.UofM_Theme_2 = {
  attach: function(context, settings) {
    var windowH = jQuery(window).height();
    var boxT = jQuery('.islandora-basic-collection-grid').offset().top;
    var boxH = jQuery('.islandora-basic-collection-grid').height();
    if ((boxT + boxH) < windowH){
      new_height = windowH - boxT - 10; /* 10px to leave a small gap at the bottom */
      jQuery('.islandora-basic-collection-grid').css('height',new_height + 'px');
    }
  }
} 
