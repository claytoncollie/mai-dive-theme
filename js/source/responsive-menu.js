/*
 GPL-2.0+
*/
(function(p,b,y){function q(){var a=b('button[id^\x3d"genesis-mobile-"]').attr("id");if("undefined"!==typeof a){"none"===l(a)&&(b(".menu-toggle, .genesis-responsive-menu .sub-menu-toggle").removeClass("activated").attr("aria-expanded",!1).attr("aria-pressed",!1),b(".genesis-responsive-menu, .genesis-responsive-menu .sub-menu").attr("style",""));var c=b(".genesis-responsive-menu .js-superfish"),d="destroy";"function"===typeof c.superfish&&("none"===l(a)&&(d={delay:100,animation:{opacity:"show",height:"show"},
dropShadows:!1,speed:"fast"}),c.superfish(d));r(a);t(a)}}function u(){var a=b(this),c=a.next("nav");a.attr("id","genesis-mobile-"+b(c).attr("class").match(/nav-\w*\b/))}function t(a){if(null!=f){var c=f[0],d=b(f).filter(function(a){if(0<a)return a});"none"!==l(a)?(b.each(d,function(a,d){b(d).find(".menu \x3e li").addClass("moved-item-"+d.replace(".","")).appendTo(c+" ul.genesis-nav-menu")}),b(k(d)).hide()):(b(k(d)).show(),b.each(d,function(a,d){b(".moved-item-"+d.replace(".","")).appendTo(d+" ul.genesis-nav-menu").removeClass("moved-item-"+
d.replace(".",""))}))}}function v(){var a=b(this);m(a,"aria-pressed");m(a,"aria-expanded");a.toggleClass("activated");a.next("nav").slideToggle("fast")}function w(){var a=b(this),c=a.closest(".menu-item").siblings();m(a,"aria-pressed");m(a,"aria-expanded");a.toggleClass("activated");a.next(".sub-menu").slideToggle("fast");c.find(".sub-menu-toggle").removeClass("activated").attr("aria-pressed","false");c.find(".sub-menu").slideUp("fast")}function r(a){var c=n();0< !b(c).length||b.each(c,function(d,
c){var e=c.replace(".","");d="genesis-"+e;var h="genesis-mobile-"+e;"none"==l(a)&&(d="genesis-mobile-"+e,h="genesis-"+e);e=b('.genesis-skip-link a[href\x3d"#'+d+'"]');null!==f&&c!==f[0]&&e.toggleClass("skip-link-hidden");0<e.length&&(c=e.attr("href"),c=c.replace(d,h),e.attr("href",c))})}function l(a){a=p.getElementById(a);return window.getComputedStyle(a).getPropertyValue("display")}function m(a,b){a.attr(b,function(a,b){return"false"===b})}function k(a){return b.map(a,function(a,b){return a}).join(",")}
function n(){var a=[];null!==f&&b.each(f,function(b,d){a.push(d.valueOf())});b.each(e.others,function(b,d){a.push(d.valueOf())});return 0<a.length?a:null}var g="undefined"===typeof genesis_responsive_menu?"":genesis_responsive_menu,e={},f=[];b.each(g.menuClasses,function(a){e[a]=[];b.each(this,function(c,d){c=b(d);1<c.length?b.each(c,function(c,g){c=d+"-"+c;b(this).addClass(c.replace(".",""));e[a].push(c);"combine"===a&&f.push(c)}):1==c.length&&(e[a].push(d),"combine"===a&&f.push(d))})});"undefined"==
typeof e.others&&(e.others=[]);1==f.length&&(e.others.push(f[0]),f=e.combine=null);var x={init:function(){if(0!=b(n()).length){var a="undefined"!==typeof g.menuIconClass?g.menuIconClass:"dashicons-before dashicons-menu",c="undefined"!==typeof g.subMenuIconClass?g.subMenuIconClass:"dashicons-before dashicons-arrow-down-alt2",d=b("\x3cbutton /\x3e",{"class":"menu-toggle","aria-expanded":!1,"aria-pressed":!1}).append(g.mainMenu),h=b("\x3cbutton /\x3e",{"class":"sub-menu-toggle","aria-expanded":!1,"aria-pressed":!1}).append(b("\x3cspan /\x3e",
{"class":"screen-reader-text",text:g.subMenu}));b(k(e)).addClass("genesis-responsive-menu");b(k(e)).find(".sub-menu").before(h);null!==f?(h=e.others.concat(f[0]),b(k(h)).before(d)):b(k(e.others)).before(d);b(".menu-toggle").addClass(a);b(".sub-menu-toggle").addClass(c);b(".menu-toggle").on("click.genesisMenu-mainbutton",v).each(u);b(".sub-menu-toggle").on("click.genesisMenu-subbutton",w);b(window).on("resize.genesisMenu",q).triggerHandler("resize.genesisMenu")}}};b(p).ready(function(){null!==n()&&
x.init()})})(document,jQuery);

jQuery(function( $ ){

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
	
});