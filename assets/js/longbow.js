/**
 * The main Longbow javascript file.
 */

( function($) {
	"use strict";

    console.log('longbow');

	var WOCLongbow = function() {
		var self = this;
		var pageType = {

		};

		var elements = {
			body: $('body')
		}

		var methods = {};

		var events = function() {

		};

		var init = function() {
			events();

            var slideout = new Slideout({
                'panel': document.getElementById('content'),
                'menu': document.getElementById('site-navigation'),
                'padding': 256,
                'tolerance': 70
            });
		};

        init();
	};


	var longbow = new WOCLongbow();
}) (jQuery);