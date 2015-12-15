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

	
	//* Force full-width-content layout setting
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
	
	// Remove primary sidebar and replace with secondary sidebar
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
		
	/** Add custom loop */
	add_action( 'genesis_sidebar', 'maidive_awards_custom_loop' );
		
}


// Show all posts in this custom post type
function maidive_awards_custom_loop() {
    
  	$awards = get_pages(
		array(
			'post_type' => 'maidive_award',
			'posts_per_page' => -1
    	)
	);
	
	echo '<section class="widget">';
		echo '<h4 class="widget-title">Awards</h4>';
			foreach( $awards as $award ):
				echo '<p>'.get_the_post_thumbnail( $award->ID ).'</p>';
    		endforeach;
	echo '</section>';
 
}



// Run the Genesis loop
genesis();