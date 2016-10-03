<?php
/**
 *
 * @author Clayton Collie
 * @package Mai Dive
 * @subpackage Customizations
 */

/*
Template Name: Two Columns
*/

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action('genesis_entry_content', 'maidive_two_column', 8);
function maidive_two_column() {
	
	$left 	= get_field('maidive_page_left_column'); 
	$right 	= get_field('maidive_page_right_column');

	if( $left || $right ) {
		echo '<div class="first one-half">';
			echo $left;
		echo '</div>';

		echo '<div class="one-half">';
			echo $right;
		echo '</div>';
	}
}

//* Run the Genesis loop
genesis();
