/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

 /*
  * whikloj - 2013-05-24
  *
  * IE 8 doesn't know these HTML5 elements, so we create them once so we can style them in our CSS.
  */
 document.createElement('header');
 document.createElement('footer');
 document.createElement('section');
 document.createElement('aside');
 document.createElement('nav');
 document.createElement('article');

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function (jQuery, Drupal, window, document, undefined) {

  jQuery(document).ready(function(){
    // Setup up onclick handler for homepage tabs
    jQuery('.islandora-solr-facet-wrapper h3').click(
      function(){
        var showIt = (jQuery(this).siblings().css('display') == 'none' ? 1 : 0);
        jQuery('.islandora-solr-facet, .islandora-solr-range-slider, .islandora-solr-date-filter').hide();
        jQuery('.islandora-solr-facet-wrapper h3').removeClass('expanded');
        if (showIt){
          jQuery(this).addClass('expanded').siblings('.islandora-solr-facet, .islandora-solr-range-slider, .islandora-solr-date-filter').show();
        }
      });
    jQuery('.islandora-solr-range-slider, .islandora-solr-date-filter').css('left',0).hide(); // Move FLOT graph over and hide now
    // 2013-06-17 whikloj - 
    //   Removing the selectBoxIt as it requires jQuery-UI 10 and that requires the jQuery Update module which 
    //   causes problems with the Drupal overlay administration pages.
    /*if (jQuery('#edit-collection-select').length > 0){
      jQuery('#edit-collection-select').selectBoxIt({'theme':'bootstrap'});
      jQuery('#edit-collection-select').change(function(){ 
        jQuery("#edit-collection-select option").removeAttr("selected");
        jQuery("#edit-collection-select option[value='" + jQuery('#edit-collection-selectSelectBoxItText').attr('data-val') + "']").attr('selected','selected');
      });
    }*/
  });

  jQuery(window).load(function(){ 
    if (jQuery('.islandora-compound-thumbs').length > 0 && jQuery('.islandora-compound-thumbs').width() > jQuery('.islandora-compound-thumbs-wrapper').width()){
      var activeLeft = jQuery('.islandora-compound-thumb a.active').offset().left;
      var wrapWidth = jQuery('.islandora-compound-thumbs-wrapper').width();
      var wrapLeft = jQuery('.islandora-compound-thumbs-wrapper').offset().left;
      if (activeLeft > (wrapLeft + wrapWidth)){
        jQuery('.islandora-compound-thumb a.active').scrollParent().animate({'scrollLeft': (activeLeft + (wrapWidth / 2 )) + 'px'},500);
      }
    }
  });

})(jQuery, Drupal, this, this.document);
