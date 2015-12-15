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

	if ( is_post_type_archive( 'maidive_accomodation' ) ) {
		
		// 2. Add post class for single articles
		add_filter( 'post_class', 'maidive_archive_accomodation_class' );
		
		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
		
		//* Add featured image in archive view Entry Content above Excerpt
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
		
		/** Replace the standard loop with our custom loop */
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'maidive_accomodation_custom_loop' );
		
	}
}

// 3.
function maidive_archive_accomodation_class( $classes ) {
	
	global $wp_query;
		
	$classes[] = 'one-half';
	
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 2 )
		$classes[] = 'first';
	return $classes;
}

// Show all posts in this custom post type
function maidive_accomodation_custom_loop() {
 
    global $query_args; 
    
  	$args = array(
		'post_type' => 'accomodation',
		'posts_per_page'   => -1,
    );
	

    genesis_custom_loop( wp_parse_args($query_args, $args) );
 
}



// Run the Genesis loop
genesis();