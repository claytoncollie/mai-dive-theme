<?php
/**
 * Template Name: Single - Gallery
 *
 * @package Mai Dive Child Theme
 * @author Clayton Collie
 * @since 1.0.0
*/

add_action( 'genesis_meta', 'maidive_single_gallery_genesis_meta' );
function maidive_single_gallery_genesis_meta() {
		
	//* Enqueue scripts and styles
	add_action( 'wp_enqueue_scripts', 'rc_load_object_scripts' );
	
	// Add gallery loop from Advanced Custom Fields		
	add_action('genesis_loop','maidive_gallery_do_loop', 12);
	
	// Remove defualt sidebars
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
	
	//* Add custom sidebar
	add_action( 'genesis_sidebar', 'maidive_sidebar_gallery' );

}

// Enqueue scripts
function rc_load_object_scripts() {

	wp_enqueue_script( 'flex-slider', get_bloginfo( 'stylesheet_directory' ) . '/js/flex-slider.js', array( 'jquery' ), '1.0.0' );

}

// Gallery Loop
function maidive_gallery_do_loop() {
	
	$images = get_field('maidive_gallery_photos');

	if( $images ) {
		echo '<div id="slider" class="flexslider entry">';
			echo '<ul class="slides">';
				foreach( $images as $image ): 
					echo '<li data-thumb="'.$image['sizes']['thumbnail'].'">';
						echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" />';
					echo '</li>';
				endforeach;
			echo '</ul>';
		echo '</div>';
	}
}

// Custom sidebar only for adventures
function maidive_sidebar_gallery() {

	genesis_widget_area( 'sidebar-gallery' );
	
}


//* Run the Genesis loop
genesis();