<?php
/**
 * Template Name: Archive - Adventure
 *
 * @package Mai Dive Child Theme
 * @author Clayton Collie
 * @since 1.0.0
*/

add_action( 'genesis_meta', 'maidive_archive_adventure_genesis_meta' );
function maidive_archive_adventure_genesis_meta() {

	if ( is_post_type_archive( 'maidive_adventure' ) ) {
		
		// 2. Add post class for single articles
		add_filter( 'post_class', 'maidive_archive_adventure_class' );
		
		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
		
		//* Add featured image in archive view Entry Content above Excerpt
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

		
	}
}

// 3.
function maidive_archive_adventure_class( $classes ) {
	
	global $wp_query;
		
	$classes[] = 'one-half';
	
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 2 )
		$classes[] = 'first';
	return $classes;
}





// Run the Genesis loop
genesis();