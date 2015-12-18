<?php
/**
 * Template Name: Archive - Accomodation
 *
 * @package Mai Dive Child Theme
 * @author Clayton Collie
 * @since 1.0.0
*/

add_action( 'genesis_meta', 'maidive_archive_accomodation_genesis_meta' );
function maidive_archive_accomodation_genesis_meta() {

	// 2. Add post class for single articles
	add_filter( 'post_class', 'maidive_archive_accomodation_class' );
	
	//* Force full-width-content layout setting
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
	
}

// 3.
function maidive_archive_accomodation_class( $classes ) {
	
	global $wp_query;
		
	$classes[] = 'one-third';
	
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 3 )
		$classes[] = 'first';
	return $classes;
}

// Run the Genesis loop
genesis();