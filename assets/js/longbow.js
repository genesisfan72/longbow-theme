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
            showPosts: function() {
                // show posts only when page is ready and all images loaded
                $('.fp-post').removeClass('transparent');
            }
        };

        var events = function () {
            elements.hamburger.on('click', function() {
                elements.slideMenu.addClass('resetRight');
            });

            elements.menuClose.on('click', function() {
                elements.slideMenu.removeClass('resetRight');
            });
        };

        var init = function () {
            FastClick.attach(document.body);
            events();
            methods.showPosts();
        };

        init();
    };


    var longbow = new WOCLongbow();
})(jQuery);