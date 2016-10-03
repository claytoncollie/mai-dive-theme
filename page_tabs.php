<?php
/**
 *
 * @author Clayton Collie
 * @package Mai Dive
 * @subpackage Customizations
 */

/*
Template Name: Tabs
*/

//* Add body class
add_filter( 'body_class', 'maidive_body_class' );
function maidive_body_class( $classes ) {
	$classes[] = 'maidive-tabs';
	return $classes;
}

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action('genesis_entry_content', 'maidive_tabs', 12);
function maidive_tabs() {
	
	if( have_rows('maidive_page_tabs_container') ) {

		echo '<div id="tab-container">';
			
			echo '<ul class="tab-labels">';

				while( have_rows('maidive_page_tabs_container') ) { the_row();

					$label = get_sub_field_object('maidive_page_tab_label');

					echo' <li><a href="#'.$label['name'].'">'.$label['value'].'</a></li>';

				}

			echo '</ul>';

		// reset the rows of the repeater
		reset_rows();

			echo'<div class="tab-content">';
			  
				// second loop of same rows
				while(have_rows('maidive_page_tabs_container')) { the_row();

					$tab_content 	= get_sub_field('maidive_page_tab_content');
					$tab_label 		= get_sub_field_object('maidive_page_tab_label');

					echo '<div id="'.$tab_label['name'].'">';

						echo $tab_content;

					echo '</div>';

				}

			echo '</div>';

		echo '</div>';
	}				
}

//* Run the Genesis loop
genesis();