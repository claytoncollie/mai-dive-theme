jQuery(function( $ ){
	
	// Dynamic front page slideshow and window height
	if(window.innerWidth > 800) {
		var adminHeight = $('#wpadminbar').outerHeight();
		var siteHeaderHeight = $('.site-header').outerHeight();
		var siteInnerHeight = $('.site-inner').outerHeight();
		var windowHeight = $(window).height();
		var newHeight = windowHeight - siteHeaderHeight - siteInnerHeight - adminHeight;
		
		$('.home-top') .css({'height': newHeight +'px'});
	}
		
	$(window).resize(function(){
		if(window.innerWidth > 800) {
			var adminHeight = $('#wpadminbar').outerHeight();
			var siteHeaderHeight = $('.site-header').outerHeight();
			var siteInnerHeight = $('.site-inner').outerHeight();
			var windowHeight = $(window).height();
			var newHeight = windowHeight - siteHeaderHeight - siteInnerHeight - adminHeight;
			
			$('.home-top') .css({'height': newHeight +'px'});
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
	$(".watch-video").click(function(){
		$(".site-header").toggleClass("hidden");
		$(".site-container").toggleClass("hidden");
	});
});