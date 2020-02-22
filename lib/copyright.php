<?php
/**
 * Copyright
 *
 * @package      Mai Dive Theme
 * @author       Clayton Collie <clayton.collie@gmail.com>
 * @copyright    Copyright (c) 2015, Mai Dive Astrolabe Reef Resort
 */

add_filter( 'genesis_footer_output', 'maidive_get_the_footer_credits', 10, 3 );
/**
 * Filter the default credits for the copyrigght information.
 *
 * @param string $output The footer output.
 * @param string $backtotop Unused. Was $backtotop_text, maintained for backwards compatibility.
 * @param string $creds_text The credit text.
 * @return string
 */
function maidive_get_the_footer_credits( $output, $backtotop, $creds_text ) : string {
	$credits        = '[footer_copyright] All Rights Reserved';
	$site_title     = get_bloginfo( 'name' );
	$login          = do_shortcode( '[footer_loginout]' );
	$privacy_policy = get_the_privacy_policy_link();

	$output = '<div class="credits">' . $credits . '<span style="margin: 0 10px;">|</span>' . $site_title . '<span style="margin: 0 10px;">|</span>' . $privacy_policy . '<span style="margin: 0 10px;">|</span>' . $login . '</div>';

	return $output;
}
