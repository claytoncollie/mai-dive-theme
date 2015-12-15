<?php
/**
 * Template Name: Archive - Gallery
 *
 * @package Mai Dive Child Theme
 * @author Clayton Collie
 * @since 1.0.0
*/

add_action( 'genesis_meta', 'maidive_archive_gallery_genesis_meta' );
function maidive_archive_gallery_genesis_meta() {

	if ( is_post_type_archive( 'maidive_gallery' ) ) {
		
		// 2. Add post class for single articles
		add_filter( 'post_class', 'maidive_archive_gallery_class' );
		
		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		// Remove content excerpt from achive view
		remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
		
		//* Add featured image in archive view Entry Content above Excerpt
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
		add_action( 'genesis_entry_header', 'maidive_archive_gallery_featured_image', 8 );

	}
}

// 3.
function maidive_archive_gallery_class( $classes ) {
	
	global $wp_query;
		
	$classes[] = 'one-fourth';
	
	if( 0 == $wp_query->current_post || 0 == $wp_query->current_post % 4 )
		$classes[] = 'first';
	return $classes;
}

// Add featured image for specific size
function maidive_archive_gallery_featured_image() {

	$image_args = array(
		'size' => 'maidive-archive-gallery',
	);

	$image = genesis_get_image( $image_args );

	if ( $image ) {
		echo '<a href="' . get_permalink() . '">' . $image .'</a>';
	}

}




// Run the Genesis loop
genesis();