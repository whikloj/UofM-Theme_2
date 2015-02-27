Drupal.behaviors.UofM_Theme_2 = {
  attach: function(context, settings) {
    if (jQuery('.islandora-basic-collection-list, .islandora-basic-collection-grid, .islandora-solr-grid, .islandora-solr-list').length > 0){
      var windowH = jQuery(window).height();
      var boxT = jQuery('.islandora-basic-collection-list, .islandora-basic-collection-grid, .islandora-solr-grid, .islandora-solr-list').offset().top;
      var boxH = jQuery('.islandora-basic-collection-list, .islandora-basic-collection-grid, .islandora-solr-grid, .islandora-solr-list').height();
      if ((boxT + boxH) < windowH){
        new_height = windowH - boxT - 10; /* 10px to leave a small gap at the bottom */
        jQuery('.islandora-basic-collection-list, .islandora-basic-collection-grid, .islandora-solr-grid, .islandora-solr-list').css('height',new_height + 'px');
      }
    }
  }
}
