Drupal.behaviors.UofM_Theme_2 = {
  attach: function(context, settings) {
    if (jQuery('.islandora-basic-collection-grid, .islandora-solr-grid').length > 0){
      var windowH = jQuery(window).height();
      var boxT = jQuery('.islandora-basic-collection-grid, .islandora-solr-grid').offset().top;
      var boxH = jQuery('.islandora-basic-collection-grid, .islandora-solr-grid').height();
      if ((boxT + boxH) < windowH){
        new_height = windowH - boxT - 10; /* 10px to leave a small gap at the bottom */
        jQuery('.islandora-basic-collection-grid, .islandora-solr-grid').css('height',new_height + 'px');
      }
    }
  }
}
