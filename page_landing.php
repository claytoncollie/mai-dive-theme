<?php
/**
 *
 * @author Clayton Collie
 * @package Mai Dive
 * @subpackage Customizations
 */

/*
Template Name: Landing
*/

//* Add front-page body class
add_filter( 'body_class', 'maidive_landing_body_class' );
function maidive_landing_body_class( $classes ) {
	$classes[] = 'landing-page';
	return $classes;
}

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'wp_enqueue_scripts', 'maidive_load_video_scripts' ); 

// watch video button
remove_action('genesis_after','maidive_watch_video');

// Mobile toolbar
remove_action('genesis_after','maidive_mobile_toolbar');

//* Remove the footer
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

//* Run the Genesis loop
genesis();
