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

      // Make searchbar stick to the top of the screen.
      var searchbarTop = jQuery('#searchbar').offset().top;
      jQuery(window).scroll(function(){
        //console.log(jQuery(window).scrollTop());
        if (jQuery(window).scrollTop() > searchbarTop) {
          jQuery('#searchbar').addClass('position-fixed');
        } else if (jQuery(window).scrollTop() > searchbarTop) {
          jQuery('#searchbar').removeClass('position-fixed');
        }
      });

      // Scroll active compound into view.
      if (jQuery('.islandora-compound-thumbs, .islandora-compound-jail-thumbs').length > 0) {
        var active = jQuery('.islandora-compound-thumb a.active:visible, .islandora-compound-object-jail-active:visible');
        var activeLeft = jQuery(active).offset().left;
        var wrapWidth = jQuery('.islandora-compound-thumbs-wrapper, .islandora-compound-jail-thumbs').width();
        var wrapLeft = jQuery('.islandora-compound-thumbs-wrapper, .islandora-compound-jail-thumbs').offset().left;
        if (activeLeft > (wrapLeft + wrapWidth)){
          jQuery(active).scrollParent().animate({'scrollLeft': (activeLeft - wrapLeft - (wrapWidth / 2)) + 'px'},500);
        }
      }

      // Show and hide captions from new grid display.
      if (jQuery('.islandora-newspaper-issue, .solr-grid-thumb, .islandora-basic-collection-thumb').length > 0) {
        jQuery('.solr-grid-thumb, .solr-grid-caption, .islandora-basic-collection-thumb, .islandora-basic-collection-caption, .islandora-newspaper-issue .islandora-object-thumb, .islandora-newspaper-issue .islandora-object-caption').mouseover(function(){
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
