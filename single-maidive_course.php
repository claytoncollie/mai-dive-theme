<?php
/**
 * Template Name: Single - Course
 *
 * @package Mai Dive Child Theme
 * @author Clayton Collie
 * @since 1.0.0
*/

add_action( 'genesis_meta', 'maidive_single_course_genesis_meta' );
function maidive_single_course_genesis_meta() {
					
	//* Force layout
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
	
	// Change Schema
	add_filter( 'genesis_attr_body', 'maidive_schema_service', 20 );
	
	// Remove defualt sidebars
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
	
	//* Add custom sidebar
	add_action( 'genesis_sidebar', 'maidive_sidebar_course' );
	
}


// Change schema to Service
function maidive_schema_service( $attributes ) {
  
    $attributes['itemtype']  = 'http://schema.org/Service';
 
    return $attributes;
 
}


// Custom sidebar only for courses
function maidive_sidebar_course() {

	genesis_widget_area( 'sidebar-courses');
	
}
	

//* Run the Genesis loop
genesis();