<?php
/**
 * This file adds the Home Page to the Mai Dive Child Theme.
 *
 * @author Clayton Collie
 * @package Mai Dive 
 * @subpackage Customizations
 */
add_action( 'genesis_meta', 'maidive_home_genesis_meta' );
function maidive_home_genesis_meta() {

	if ( is_front_page() ) {

		//* Force content-sidebar layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
		
		//* Add maidive-home body class
		add_filter( 'body_class', 'maidive_body_class' );
		
		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		
		//* Add homepage home-top
		add_action( 'genesis_after_header', 'maidive_homepage_top' );

		//* Add homepage widgets
		add_action( 'genesis_loop', 'maidive_homepage_widgets' );

	}

}

function maidive_body_class( $classes ) {

	$classes[] = 'maidive-home';
	return $classes;
	
}
function maidive_homepage_top() {
	
	echo '<div id="home-top" class="home-top widget-area">';
	
		echo '<div class="wrap">';
	
			genesis_widget_area( 'home-top-left', array(
				'before' => '<div class="first three-fourths widget-area hero">',
				'after'  => '</div>',
			) );
		
			genesis_widget_area( 'home-top-right', array(
				'before' => '<div class="one-fourth widget-area trip-advisor">',
				'after'  => '</div>',
			) );
	
		echo '</div>';
		
	echo '</div>';
	
}

/*function maidive_homepage_top() {

	genesis_widget_area( 'home-top', array(
		'before' => '<div id="home-top" class="home-top widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
}*/

function maidive_homepage_widgets() {
	
	genesis_widget_area( 'home-middle', array(
		'before' => '<div id="home-middle" class="home-middle widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

genesis();
