jQuery(document).ready(function() {

    jQuery('#sortable-table tbody').sortable({
        axis: 'y',
        handle: '.column-order img',
        placeholder: 'ui-state-highlight',
        forcePlaceholderSize: true,
        update: function(event, ui) {
            var theOrder = jQuery(this).sortable('toArray');

            var data = {
                action: 'homepage_update_post_order',
                postType: jQuery(this).attr('data-post-type'),
                order: theOrder
            };

            //jQuery.post(ajaxurl, data);

            jQuery.ajax({
                type        : 'POST',
                url         : ajaxurl,
                data        : data,

                success     : function( data ) {
                                jQuery('.homepage-message').html('New order saved.');
                                setTimeout(function() { jQuery('.homepage-message').html(''); }, 3000);
                }
            });
        }
    }).disableSelection();

});