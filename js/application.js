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

    enquire.register("screen and (max-width: 48em)", {
        match: function () {
            // Move the nav
            jQuery('header .nav-button').data('toggleButton').off();
            jQuery('header .nav nav').removeAttr('style');
        },

        unmatch: function () {
            var animateAtStartup = false;
            jQuery('.nav-button').data('toggleButton').on(animateAtStartup);
            jQuery('header .nav nav').removeAttr('style');
        }
    });

    var url = window.location.href;
    jQuery('#menu a[href="'+url+'"]').addClass('current-page');

    var headerHeight = jQuery('header.header').outerHeight(true);
    if( jQuery(window).scrollTop() > headerHeight) {
        jQuery('header.header').addClass('solid-colour');
    }

    if(jQuery('.main').hasClass('no-banner')) {
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