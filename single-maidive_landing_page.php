<?php
/**
 * Template Name: Single - Landing Page
 *
 * @package Mai Dive Child Theme
 * @author Clayton Collie
 * @since 1.0.0
*/

add_action( 'genesis_meta', 'maidive_single_landing_page_genesis_meta' );
function maidive_single_landing_page_genesis_meta() {
	
	//* Add custom body class to the head
	add_filter( 'body_class', 'maidive_add_body_class' );	
	
	//* Force full width content layout
	add_filter( 'genesis_site_layout', '__genesis_return_content_sidebar' );
	
	//* Remove navigation
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	
	//* Remove breadcrumbs
	remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
	
	// Remove defualt sidebars
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
	
	//* Add custom sidebar
	add_action( 'genesis_sidebar', 'maidive_sidebar_landing' );
	
	//* Add custom header
	add_action( 'genesis_header', 'maidive_header_right' );
	
	//* Remove site footer widgets
	remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
	
	//* Remove site footer elements
	remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
}

// Add body class to page template
function maidive_add_body_class( $classes ) {

   $classes[] = 'maidive-landing';
   return $classes;
   
}

// Custom sidebar only for courses
function maidive_sidebar_landing() {

	genesis_widget_area( 'sidebar-landing');
	
}

// Custom sidebar only for courses
function maidive_header_right() {

	genesis_widget_area( 'header-right-landing');
	
}


//* Run the Genesis loop
genesis();
