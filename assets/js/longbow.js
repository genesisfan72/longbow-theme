/**
 * The main Longbow javascript file.
 */

(function ($) {
    "use strict";

    var WOCLongbow = function () {
        var self = this;
        var pageType = {};

        var elements = {
            body: $('body'),
            hamburger: $('.menu-toggle'),
            menuClose: $('.close-menu'),
            slideMenu: $('.slide-menu')
        }

        var methods = {};

        var events = function () {
            elements.hamburger.on('click', function() {
                elements.slideMenu.addClass('resetRight');
            });

            elements.menuClose.on('click', function() {
                elements.slideMenu.removeClass('resetRight');
            });
        };

        var init = function () {
            events();
        };

        init();
    };


    var longbow = new WOCLongbow();
})(jQuery);