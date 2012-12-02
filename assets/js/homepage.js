/**
 * Homepage JS
 * @author: Derek Marcinyshyn <derek@marcinyshyn.com>
 */

jQuery(window).load(function(){

    // set up isotope
    jQuery('#mmm-homepage-wrapper').isotope({
        // options
        itemSelector: '.mmm-homepage-element',
        layoutMode: 'fitRows'
    });

});