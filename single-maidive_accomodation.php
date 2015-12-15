<?php
/**
 * Template Name: Single - Accomodation
 *
 * @package Mai Dive Child Theme
 * @author Clayton Collie
 * @since 1.0.0
*/

add_action( 'genesis_meta', 'maidive_single_accomodation_genesis_meta' );
function maidive_single_accomodation_genesis_meta() {
		
	// Change Schema
	add_filter( 'genesis_attr_body', 'maidive_schema_service', 20 );
	
	// Remove defualt sidebars
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
	
	//* Add custom sidebar
	add_action( 'genesis_sidebar', 'maidive_sidebar_accomodation' );
	
}


// Change schema to Service
function maidive_schema_service( $attributes ) {
  
    $attributes['itemtype']  = 'http://schema.org/Service';
 
    return $attributes;
 
}


// Custom sidebar only for accomodations
function maidive_sidebar_accomodation() {

	genesis_widget_area( 'sidebar-accomodations');
	
}
	

//* Run the Genesis loop
genesis();