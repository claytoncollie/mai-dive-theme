<?php
/**
 * Template Name: Page Builder
 *
 * @package      Mai Dive Theme
 * @author       Clayton Collie <clayton.collie@gmail.com>
 * @copyright    Copyright (c) 2015, Mai Dive Astrolabe Reef Resort
 */

// Force full-width-content layout.
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove all default page information.
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

add_filter( 'body_class', 'maidive_page_builder_body_class' );
/**
 * Add custom body class.
 *
 * @param array $classes Classes.
 * @return array
 */
function maidive_page_builder_body_class( array $classes ) : array {
	$classes[] .= 'page-builder';
	return $classes;
}

// Run the Genesis loop.
genesis();
