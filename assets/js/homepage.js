/**
 * Homepage JS
 * @author: Derek Marcinyshyn <derek@marcinyshyn.com>
 */
jQuery(window).load(function() {
    jQuery('#homepage-loader').css('display', 'none');

    jQuery('.mmm-homepage-wrapper').css('display', 'block');

    // set up isotope
    jQuery('#mmm-homepage-wrapper').isotope({
        // options
        itemSelector: '.mmm-homepage-element',
        layoutMode: 'masonry',

        masonry: {
            columnWidth: 10,
            gutterWidth: 0
        },

        animationEngine: 'best-available',

        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });

});