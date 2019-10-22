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

  Drupal.behaviors.UofM_Theme_2 = {
    attach: function(context, settings) {

      if (jQuery('#searchbar', context).length > 0) {
        // Make searchbar stick to the top of the screen.
        var searchbarTop = jQuery('#searchbar', context).offset().top;
        jQuery(window).scroll(function () {
          //console.log(jQuery(window).scrollTop());
          if (jQuery(window).scrollTop() > searchbarTop) {
            jQuery('#searchbar', context).addClass('position-fixed');
          } else if (jQuery(window).scrollTop() < searchbarTop) {
            jQuery('#searchbar', context).removeClass('position-fixed');
          }
        });
      }

      // Show and hide captions from new grid display.
      if (jQuery('.islandora-objects-grid, .islandora-newspaper-issue, .solr-grid-thumb, .islandora-basic-collection-thumb', context).length > 0) {
        jQuery('.solr-grid-thumb, .solr-grid-caption, .islandora-basic-collection-thumb, .islandora-basic-collection-caption, .islandora-object-thumb, .islandora-object-caption', context).mouseover(function(){
          jQuery(this).parent().children('.solr-grid-caption, .islandora-basic-collection-caption, .islandora-object-caption').show();
        }).mouseout(function(){
          jQuery(this).parent().children('.solr-grid-caption, .islandora-basic-collection-caption, .islandora-object-caption').hide();
        });
      }

      // Toggle Dental information box if exists.
      jQuery('.uofm-dental-info h2', context).click(function(){
        jQuery(this).next('table').toggle(function(){
          var tmpT = (jQuery(this).is(':visible') ? 'hide' : 'show');
          jQuery(this).prev('h2').text('Information (' + tmpT + ')');
        });
      });

    }
  };

})(jQuery, Drupal, this, this.document);
