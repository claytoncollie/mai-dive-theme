<?php
/**
 * Featured Image
 *
 * @package      Mai Dive Theme
 * @author       Clayton Collie <clayton.collie@gmail.com>
 * @copyright    Copyright (c) 2015, Mai Dive Astrolabe Reef Resort
 */

add_action( 'wp', 'maidive_featured_image_hero' );
/**
 * Add support for feautred image hero on Posts and Pages.
 *
 * @return void
 */
function maidive_featured_image_hero() {

	// Bail if on page builder template.
	if ( is_page_template( 'page_builder.php' ) ) {
		return;
	}

	// Bail if we are on archive or blog home.
	if ( is_home() || is_archive() ) {
		return;
	}

	// Bail if we dont have a featured image present.
	if ( ! has_post_thumbnail() ) {
		return;
	}

	// Remove page title and entry header markup.
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

	// Add markjup for featured image and page title.
	add_action( 'genesis_after_header', 'maidive_do_the_featured_image_hero' );

	// Remove post info.
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

	// Add body class.
	add_filter( 'body_class', 'maidive_featured_image_body_class' );
}

/**
 * Display the featured image markup.
 *
 * @return void
 */
function maidive_do_the_featured_image_hero() {
	printf(
		'<section class="hero has-background-dim" style="background-image: url(%s);"><div class="wrap"><h1>%s</h1><hr class="wp-block-separator"><p>%s</p></div></section>',
		esc_url( get_the_post_thumbnail_url( get_the_ID(), 'maidive_backstretch' ) ),
		esc_html( get_the_title() ),
		esc_html( is_single() ? get_the_date() : '' )
	);
}

/**
 * Add custom body class.
 *
 * @param array $classes Classes.
 * @return array
 */
function maidive_featured_image_body_class( array $classes ) : array {
	$classes[] .= 'has-featured-image';
	return $classes;
}
