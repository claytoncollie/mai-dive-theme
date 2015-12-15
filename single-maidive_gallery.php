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

	if ( is_singular( 'maidive_gallery' ) ) {
		
		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		// Change Schema
		add_filter( 'genesis_attr_body', 'maidive_schema_service', 20 );
				
		//* Enqueue scripts and styles
		add_action( 'wp_enqueue_scripts', 'rc_load_object_scripts' );
		
		// Remove default loop
		remove_action('genesis_loop','genesis_do_loop');
		
		// Add gallery loop from Advanced Custom Fields		
		add_action('genesis_loop','maidive_gallery_do_loop');
	}

}

// Enqueue scripts
function rc_load_object_scripts() {

	wp_enqueue_script( 'flex-slider', get_bloginfo( 'stylesheet_directory' ) . '/js/flex-slider.js', array( 'jquery' ), '1.0.0' );

}

// Gallery Loop
function maidive_gallery_do_loop() {
	
	$images = get_field('maidive_gallery_photos');

	if( $images ) {
		echo '<div id="slider" class="flexslider">';
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




// Change schema to Service
function maidive_schema_service( $attributes ) {
  
    $attributes['itemtype']  = 'http://schema.org/Service';
 
    return $attributes;
 
}



	

//* Run the Genesis loop
genesis();