/**
 * @file
 * Add JAIL for fancy loading of images for UofM Theme.
 */

(function ($) {
    Drupal.settings.UofM_Theme_2_JAIL = {
        active: undefined,
        wrapper: undefined
    },
    Drupal.behaviors.UofM_Theme_2_JAIL = {
        scrollCompoundNav: function() {
            var activeLeft = $(Drupal.settings.UofM_Theme_2_JAIL.active).offset().left;
            var wrapWidth = $(Drupal.settings.UofM_Theme_2_JAIL.wrapper).width();
            var wrapLeft = $(Drupal.settings.UofM_Theme_2_JAIL.wrapper).offset().left;
            if (activeLeft > wrapLeft + wrapWidth) {
                $(Drupal.settings.UofM_Theme_2_JAIL.wrapper).scrollLeft(activeLeft - wrapLeft - (wrapWidth / 2));
            }
            $(Drupal.settings.UofM_Theme_2_JAIL.wrapper).trigger('scroll');
        },
        attach: function(context, settings) {
            Drupal.settings.UofM_Theme_2_JAIL.active = $('.islandora-compound-thumb a.active:visible, .islandora-compound-object-jail-active:visible', context);
            Drupal.settings.UofM_Theme_2_JAIL.wrapper = $('.islandora-compound-jail-thumbs', context);
            $('img.islandora-compound-object-jail').jail({
                triggerElement: 'div.islandora-compound-jail-thumbs',
                event: 'scroll',
                offset: 200,
            });
            Drupal.behaviors.UofM_Theme_2_JAIL.scrollCompoundNav(context);
            window.setTimeout('Drupal.behaviors.UofM_Theme_2_JAIL.scrollCompoundNav()', 2000);
        }
    };
})(jQuery.noConflict(true));