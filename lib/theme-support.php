<?php
/**
 * Theme Support
 *
 * @package      Mai Dive Theme
 * @author       Clayton Collie <clayton.collie@gmail.com>
 * @copyright    Copyright (c) 2015, Mai Dive Astrolabe Reef Resort
 */

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for 1-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 1 );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Remove layout support on archive.
remove_theme_support( 'genesis-archive-layouts' );

// Unregister secondary navigation menu.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'maidive' ) ) );

// Default block stylesheet.
add_theme_support( 'wp-block-styles' );

// Align wide and align full support.
add_theme_support( 'align-wide' );

// Responsive embeds.
add_theme_support( 'responsive-embeds' );

// Genesis logo support.
add_theme_support( 'genesis-custom-logo' );

add_action( 'after_setup_theme', 'maidive_custom_logo_setup' );
/**
 * Add support for custom logo.
 *
 * @return void
 */
function maidive_custom_logo_setup() {
	add_theme_support(
		'custom-logo',
		array(
			'height'          => 150,
			'width'           => 185,
			'flex-height'     => true,
			'flex-width'      => true,
			'header_image'    => '',
			'header-selector' => '.site-title a',
		)
	);
}
