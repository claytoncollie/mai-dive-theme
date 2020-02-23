<?php
/**
 * Scripts
 *
 * @package      Mai Dive Theme
 * @author       Clayton Collie <clayton.collie@gmail.com>
 * @copyright    Copyright (c) 2015, Mai Dive Astrolabe Reef Resort
 */

add_action( 'wp_enqueue_scripts', 'maidive_load_scripts' );
/**
 * Enqueue globally minified script and attach featured image to backstretch
 *
 * @return void
 */
function maidive_load_scripts() {
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '4.4.0', false );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,700|Roboto:400,700', array(), CHILD_THEME_VERSION, false );

	wp_enqueue_script( 'global', get_stylesheet_directory_uri() . '/js/global.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	wp_localize_script(
		'global',
		'genesis_responsive_menu',
		array(
			'mainMenu'         => __( 'Menu', 'maidive' ),
			'menuIconClass'    => '',
			'subMenu'          => __( 'Submenu', 'maidive' ),
			'subMenuIconClass' => '',
			'menuClasses'      => array(
				'others' => array(
					'.nav-primary',
				),
			),
		)
	);
}
