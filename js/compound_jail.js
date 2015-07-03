/**
 * @file
 * Add JAIL for fancy loading of images for UofM Theme.
 */

(function ($) {
    Drupal.behaviors.islandora_compound_object_JAIL = {
        attach: function(context, settings) {
            $('img.islandora-compound-object-jail').jail({
                triggerElement:'#block-islandora-compound-object-compound-jail-display .islandora-compound-jail-thumbs',
                event: 'scroll',
                offset: 200
            });
        }
    };
})(jQuery.noConflict(true));