<?php
/**
 * Blog Home
 *
 * @package Mai Dive Child Theme
 * @author Clayton Collie
 * @since 1.0.0
*/

add_action( 'genesis_meta', 'maidive_blog_home_genesis_meta' );
function maidive_blog_home_genesis_meta() {

	if ( is_home() ) {

		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
				
		//* Remove the entry meta in the entry header
		add_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		add_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		add_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
		
		// Remove primary sidebar and replace with secondary sidebar
		remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
		add_action( 'genesis_sidebar', 'genesis_do_sidebar_alt' );
		
	}
}

// Run the Genesis loop
genesis();