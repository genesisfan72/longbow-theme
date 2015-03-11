/**
 * The main Longbow javascript file.
 */

( function($) {
	"use strict";

	var WOCLongbowApp = function() {
		var self = this;
		var pageType = 'page';

		var elements = {
		};
		var methods = {};
		var events = function() {

		};

		var init = function() {
			self.events();
			if ($(body).hasClass('home')) {
				self.pageType = 'home';
			}
		};
	};


	var longbow = new WOCLongbowApp();
}) (jQuery);