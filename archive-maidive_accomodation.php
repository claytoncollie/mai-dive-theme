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
	
	if( wp_is_mobile() && get_option( 'maidive-accommodations-image') ) {
		// Display image from customizer
		wp_enqueue_script( 'maidive-backstretch-init', get_bloginfo( 'stylesheet_directory' ).'/js/backstretch-init.js', '', '1.0.0', true );
		$backstretch_src = array( 'src' => get_option( 'maidive-accommodations-image') );
		wp_localize_script( 'maidive-backstretch-init', 'BackStretchImg', $backstretch_src );
	}else {
		//If no videos or post thumbnails are present, use default video set in customizer
		wp_enqueue_script( 'video-min', get_stylesheet_directory_uri() . '/js/video.min.js', '', '', true );
		wp_enqueue_script( 'bigvideo-init', get_stylesheet_directory_uri() . '/js/bigvideo-init.js', array( 'video-min' ), '1.0.0', true );
		$bigvideo_mp4 = get_option( 'maidive-accomodation-video-mp4' );
		wp_localize_script( 'bigvideo-init', 'BigVideoLocalizeMp4', $bigvideo_mp4 );
	}
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