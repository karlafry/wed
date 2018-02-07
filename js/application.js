jQuery(document).ready(function() {

    jQuery('.nav-button').toggleButton({
        on: function () {
            jQuery('header .nav').show();
            jQuery('header .nav nav').slideDown(600);
        },
        off: function (animate) {
            var animationDuration = animate === undefined || animate || animate instanceof jQuery.Event ? 600 : 0;
            jQuery('header .nav nav').slideUp(animationDuration);
        }
    });

    var url = window.location.href;
    jQuery('#menu a[href="'+url+'"]').addClass('current-page');

    var headerHeight = jQuery('header.header').outerHeight(true);
    if( jQuery(window).scrollTop() > headerHeight) {
        jQuery('header.header').addClass('solid-colour');
    }

    jQuery(window).scroll( function() {
        if( jQuery(window).scrollTop() > headerHeight) {
            jQuery('header.header').addClass('solid-colour');
        } else {
            jQuery('header.header').removeClass('solid-colour');
        }
    });
});