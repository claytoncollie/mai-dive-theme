<?php
/**
 * This file adds the Home Page to the Mai Dive Child Theme.
 *
 * @author Clayton Collie
 * @package Mai Dive 
 * @subpackage Customizations
 */
 
add_action( 'wp_enqueue_scripts', 'maidive_enqueue_scripts' );
/**
 * Enqueue Scripts
 */
function maidive_enqueue_scripts() {

	if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-middle' ) || is_active_sidebar( 'home-bottom' ) ) {
	
		wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );
		wp_enqueue_script( 'localScroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'scrollTo' ), '1.2.8b', true );
		wp_enqueue_script( 'home', get_stylesheet_directory_uri() . '/js/home.js', array( 'localScroll' ), '', true );
		
	}
}

add_action( 'genesis_meta', 'maidive_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function maidive_home_genesis_meta() {

	if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-middle' ) || is_active_sidebar( 'home-bottom' ) ) {

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
		
		//* Modify length of post excerpts
		add_filter( 'excerpt_length', 'maidive_home_excerpt_length' );

	}

}

function maidive_body_class( $classes ) {

	$classes[] = 'maidive-home';
	return $classes;
	
}

function maidive_homepage_top() {

	genesis_widget_area( 'home-top', array(
		'before' => '<div id="home-top" class="home-top widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
}

function maidive_homepage_widgets() {
	
	genesis_widget_area( 'home-middle', array(
		'before' => '<div id="home-middle" class="home-middle widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
	genesis_widget_area( 'home-bottom', array(
		'before' => '<div id="home-bottom" class="home-bottom widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

function maidive_home_excerpt_length( $length ) {

	return 35;
    
}

genesis();
