jQuery(document).on( 'click', '#forte_dismiss_notice_updates', function() {

    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'forte_dismiss_notice_updates'
        }
    });

});