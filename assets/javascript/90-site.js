jQuery(document).ready(function() {
	var el = jQuery(".cookie-notice");
	var button = jQuery(".btn-accept", el);
	if (- 1 === document.cookie.indexOf("eucookie")) {
		setTimeout(function() { el.slideDown("slow");  }, 1000);
	}
	button.on("click", function() {
		var date = new Date();
		date.setDate(date.getDate() + 365), document.cookie = "eucookie=" + escape("hide") + ";path=/;expires=" + date.toGMTString();
		el.slideUp("slow");
		return false;
	});

	jQuery(window).on("scroll", function() {

		if (jQuery(window).scrollTop() > 100) {
			jQuery('body > header').addClass('is-sticky');
		}
		else {
			jQuery('body > header').removeClass('is-sticky');
		}
	});

	jQuery('.toggle-mobilenav').click(function() {
		jQuery('#mobile-nav > ul').toggleClass('active');
		return false;
	});

	jQuery('#mobile-nav .close-menu').click(function() {
		jQuery(this).closest('ul').removeClass('active');
		return false;
	})

	jQuery('#main-nav > ul > li > a').mouseenter(function() {
		if (jQuery(this).parent().find('ul').length > 0) {
			jQuery(this).parent().addClass('show-sub');
		}
	});

	jQuery('#main-nav > ul > li').mouseleave(function() {
		if (jQuery(this).hasClass('show-sub')) {
			jQuery(this).removeClass('show-sub');
		}
	});



});