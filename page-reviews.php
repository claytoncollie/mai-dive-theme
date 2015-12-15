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
	
	//Filter Genesis H1 Post Titles to remove hyperlinks on Category pages
	add_filter( 'genesis_post_title_output', 'maidive_post_title_output', 15 );
	

		
}


// Show all posts in this custom post type
function maidive_awards_custom_loop() {
 
    global $query_args; 
    
  	$args = array(
		'post_type' => 'maidive_awards',
		'posts_per_page'   => -1,
    );
	
	//* Remove the post content (requires HTML5 theme support)
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
	
	// Add post title to loop header
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	
	echo '<section class="widget">';
		echo '<h4 class="widget-title">Awards</h4>';
	
    genesis_custom_loop( wp_parse_args($query_args, $args) );

	echo '</section>';
 
}

//Filter Genesis H1 Post Titles to remove hyperlinks on Category pages
function maidive_post_title_output( $title ) {
	
	$title = apply_filters( 'genesis_post_title_text', get_the_title() );

	$wrap = 'h2';

	//* Also, if HTML5 with semantic headings, wrap in H1
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h2' : $wrap;

	//* Build the output
	$output = genesis_markup( array(
		'html5'   => "<{$wrap} %s>",
		'xhtml'   => sprintf( '<%s class="entry-title">%s</%s>', $wrap, $title, $wrap ),
		'context' => 'entry-title',
		'echo'    => false,
	) );

	$output .= genesis_html5() ? "{$title}</{$wrap}>" : '';

	return $output;

}

// Run the Genesis loop
genesis();