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

    enquire.register("screen and (min-width: 61.25em)", {
        match: function () {
            if(jQuery('div.alt-accoms').length > 0) {
                var container = jQuery('div.alt-accoms');
                var containerTop = container.offset().top;
                var containerBottom = containerTop + container.outerHeight(true);
                var headerHeight = jQuery('header.header').outerHeight(true);
                var mapEl = jQuery('div.alt-accoms .map-result-container');

                jQuery(window).scroll( function() {
                    if ((jQuery(window).scrollTop() + headerHeight)  > containerTop && jQuery(window).scrollTop() < containerBottom) {
                        mapEl.addClass('sticky').css('top', headerHeight+'px');

                        if((mapEl.offset().top +  mapEl.outerHeight(true)) > containerBottom ) {
                            var top = containerBottom - (mapEl.offset().top + mapEl.outerHeight(true) - headerHeight + 14);
                            mapEl.css('top', top+'px');
                        }
                    } else {
                        mapEl.removeClass('sticky').removeAttr('style');
                    }
                });
            }
        },

        unmatch: function() {
            if(jQuery('div.alt-accoms').length > 0) {
                jQuery('div.alt-accoms .map-result-container').removeClass('sticky').removeAttr('style');
            }
        }
    });

    var url = window.location.href;
    jQuery('#menu a[href="'+url+'"]').addClass('current-page');

    if(jQuery('.main').hasClass('no-banner')) {
        jQuery('header.header').addClass('solid-colour');
    } else {
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
    }

    /**
     * Accordion content - read more/less
     */
    jQuery('.collapsible > h4').on('click', function() {
        jQuery(this).toggleClass('open');
        jQuery(this).next('.expandable-content').slideToggle('fast');
    });
});