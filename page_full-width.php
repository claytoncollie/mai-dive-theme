<?php
/**
 *
 * @author Clayton Collie
 * @package Mai Dive
 * @subpackage Customizations
 */

/*
Template Name: Full Width
*/

//* Force full-width-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Run the Genesis loop
genesis();
