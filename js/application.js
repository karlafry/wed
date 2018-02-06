$(document).ready(function()
{

    $('#menu').slicknav({
        prependTo:'#mobile-menu'
    });

    var url = window.location.href;
    $('#menu a[href="'+url+'"]').addClass('current-page');
    $('#mobile-menu a[href="'+url+'"]').parent('li').addClass('current-page');


});