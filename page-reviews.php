<?php
/**
 * Template Name: Page - Reviews
 *
 * @package Mai Dive Child Theme
 * @author Clayton Collie
 * @since 1.0.0
*/

add_action( 'genesis_meta', 'maidive_page_reviews_genesis_meta' );
function maidive_page_reviews_genesis_meta() {
	
	// Remove primary sidebar and replace with secondary sidebar
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

	/** Remove default sidebar */
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

	//* Add custom sidebar for page template
	add_action( 'genesis_sidebar', 'maidive_sidebar_awards_widgets' );	
}

// Call custom sidebar
function maidive_sidebar_awards_widgets() {
	
	genesis_widget_area( 'sidebar-awards');

}

// Run the Genesis loop
genesis();