<?php
/**
 * Simple Social Icons
 *
 * @package      Mai Dive Theme
 * @author       Clayton Collie <clayton.collie@gmail.com>
 * @copyright    Copyright (c) 2015, Mai Dive Astrolabe Reef Resort
 */

// Remove default style sheet.
add_filter( 'simple_social_disable_custom_css', '__return_true' );

add_filter( 'simple_social_default_styles', 'maidive_add_new_icon_default' );
/**
 * Add default icon for Simple Social Icons.
 *
 * @param array $defaults Default Icons.
 * @return array
 */
function maidive_add_new_icon_default( array $defaults ) : array {
	$defaults['tripadvisor'] = '';
	return $defaults;
}

add_filter( 'simple_social_default_profiles', 'maidive_simple_social_default_profiles' );
/**
 * Reorder and exclude certain profiles for SImple Social Icons.
 *
 * @param array $icons All Icons.
 * @return array
 */
function maidive_simple_social_default_profiles( array $icons ) : array {
	$glyphs = array(
		'tripadvisor' => '<span class="fa fa-tripadvisor"></span>',
		'facebook'    => '<span class="fa fa-facebook"></span>',
		'instagram'   => '<span class="fa fa-instagram"></span>',
		'youtube'     => '<span class="fa fa-youtube"></span>',
	);

	$icons = array(
		'tripadvisor' => array(
			'label'   => __( 'Trip Advisor URI', 'maidive' ),
			'pattern' => '<li class="social-tripadvisor"><a href="%s" %s>' . $glyphs['tripadvisor'] . '</a></li>',
		),
		'facebook'    => array(
			'label'   => __( 'Facebook URI', 'maidive' ),
			'pattern' => '<li class="social-facebook"><a href="%s" %s>' . $glyphs['facebook'] . '</a></li>',
		),
		'instagram'   => array(
			'label'   => __( 'Instagram URI', 'maidive' ),
			'pattern' => '<li class="social-instagram"><a href="%s" %s>' . $glyphs['instagram'] . '</a></li>',
		),
		'youtube'     => array(
			'label'   => __( 'YouTube URI', 'maidive' ),
			'pattern' => '<li class="social-youtube"><a href="%s" %s>' . $glyphs['youtube'] . '</a></li>',
		),
	);

	return $icons;
}
