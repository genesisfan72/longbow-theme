/**
 * The main Longbow javascript file.
 */

(function ($) {
    "use strict";

    var WOCLongbow = function () {
        var self = this;
        var pageType = {};
        var fpPostRowHeight = 200;

        var elements = {
            body: $('body'),
            hamburger: $('.menu-toggle'),
            menuClose: $('.close-menu'),
            slideMenu: $('.slide-menu'),
            nextBtn: $('.btn-next'),
            prevBtn: $('.btn-previous')
        }

        var methods = {
        };

        var events = function () {
            elements.hamburger.on('click', function() {
                elements.slideMenu.addClass('resetRight');
            });

            elements.menuClose.on('click', function() {
                elements.slideMenu.removeClass('resetRight');
            });

            //$('.fp-post').on('hover', function() {
            //    $(this).find('img').addClass('opaque');
            //});
        };

        var init = function () {
            FastClick.attach(document.body);
            events();
        };

        init();
    };


    var longbow = new WOCLongbow();
})(jQuery);