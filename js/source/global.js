jQuery(function( $ ){

	// Tabs for single attorney profiles		
	$('.maidive-tabs #tab-container').tabs();
	
	// Dynamic front page slideshow and window height
	var adminHeight = $('#wpadminbar').outerHeight();
	var siteHeaderHeight = $('.site-header').outerHeight();
	var siteInnerHeight = $('.site-inner').outerHeight();
	var windowHeight = $(window).height();
		
	if(window.innerWidth > 800 && window.innerHeight > 800) {
		var newHeight = windowHeight - siteHeaderHeight - siteInnerHeight - adminHeight;
		$('.home-top') .css({'min-height': newHeight +'px'});

		var builderHeight = windowHeight - adminHeight;
		$('.format-full-screen-hero-with-image') .css({'min-height': builderHeight +'px'});
		$('.format-full-screen-hero-with-video') .css({'min-height': builderHeight +'px'});
	}else{
		var newHeight = windowHeight - adminHeight;
		$('.home-top') .css({'min-height': newHeight +'px'});

		var builderHeight = windowHeight - adminHeight;
		$('.format-full-screen-hero-with-image') .css({'min-height': builderHeight +'px'});
		$('.format-full-screen-hero-with-video') .css({'min-height': builderHeight +'px'});
		$('.format-full-screen-hero-with-video #big-video-image') .css({'min-height': builderHeight +'px !important'});
	}
		
	$(window).resize(function(){
		var adminHeight = $('#wpadminbar').outerHeight();
		var siteHeaderHeight = $('.site-header').outerHeight();
		var siteInnerHeight = $('.site-inner').outerHeight();
		var windowHeight = $(window).height();
			
		if(window.innerWidth > 800 && window.innerHeight > 800) {
			var newHeight = windowHeight - siteHeaderHeight - siteInnerHeight - adminHeight;
			$('.home-top') .css({'min-height': newHeight +'px'});

			var builderHeight = windowHeight - adminHeight;
			$('.format-full-screen-hero-with-image') .css({'min-height': builderHeight +'px'});
			$('.format-full-screen-hero-with-video') .css({'min-height': builderHeight +'px'});
		}else{
			var newHeight = windowHeight - adminHeight;
			$('.home-top') .css({'min-height': newHeight +'px'});

			var builderHeight = windowHeight - adminHeight;
			$('.format-full-screen-hero-with-image') .css({'min-height': builderHeight +'px'});
			$('.format-full-screen-hero-with-video') .css({'min-height': builderHeight +'px'});
			$('.format-full-screen-hero-with-video #big-video-image') .css({'min-height': builderHeight +'px !important'});
		}
	});
	
	
	// Responsive Menu
	$("header .genesis-nav-menu, .nav-primary .genesis-nav-menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"><span class="menu-text">Menu</span></div>');

	$(".responsive-menu-icon").click(function(){
		$(this).next("header .genesis-nav-menu, .nav-primary .genesis-nav-menu").slideToggle();
	});

	$(window).resize(function(){
		if(window.innerWidth > 800) {
			$("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, nav .sub-menu").removeAttr("style");
			$(".responsive-menu > .menu-item").removeClass("menu-open");
		}
	});

	$(".responsive-menu > .menu-item").click(function(event){
		if (event.target !== this)
		return;
			$(this).find(".sub-menu:first").slideToggle(function() {
			$(this).parent().toggleClass("menu-open");
		});
	});
	
	// Watch Video Button
	$(".watch-video .show-text-button").addClass("hide")
	
	$(".watch-video").click(function(){
		$(".site-header").toggleClass("hide");
		$(".site-container").toggleClass("hide");
		$(".hide-text-button").toggleClass("hide");
		$(".show-text-button").toggleClass("show");
	});
	
	// Mobile Toolbar Button
	$(".mobile-toolbar .show-text-button").addClass("hide")
	
	$(".mobile-toolbar").click(function(){
		$(".site-header").toggleClass("hide");
		$(".site-container").toggleClass("hide");
		$(".hide-text-button").toggleClass("hide");
		$(".show-text-button").toggleClass("show");
	});

	
});