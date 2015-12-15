<?php
/**
 * Functions
 *
 * @package      Mai Dive Child Theme
 * @since        1.0.0
 * @author       Clayton Collie <clayton.collie@gmail.com>
 * @copyright    Copyright (c) 2015, Mai Dive Astrolabe Reef Resort
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
/**
 * Theme Setup
 * @since 1.0.0
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 */
add_action( 'genesis_setup', 'maidive_theme_setup', 15 );
function maidive_theme_setup() {
	//* Start the engine
	include_once( get_template_directory() . '/lib/init.php' );
	
	//* Set Localization (do not remove)
	load_child_theme_textdomain( 'maidive', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'maidive' ) );
	
	add_action('customize_register','maidive_customizer');
	function maidive_customizer() {
		require_once( get_stylesheet_directory() . '/lib/customize.php' );
	}
	
	//* Child theme (do not remove)
	define( 'CHILD_THEME_NAME', __( 'Mai Dive Child Theme', 'maidive' ) );
	define( 'CHILD_THEME_URL', 'https://bitbucket.org/claytoncollie/mai-dive-astrolabe-reef-resort' );
	define( 'CHILD_THEME_VERSION', '1.0.0' );
	
	//* Add HTML5 markup structure
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	
	//* Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );
	
	//* Enqueue Scripts
	add_action( 'wp_enqueue_scripts', 'maidive_load_scripts' );
	function maidive_load_scripts() {
	
		wp_enqueue_script( 'maidive-global-js', get_bloginfo( 'stylesheet_directory' ) . '/js/global.js', array( 'jquery' ), '1.0.0' );
		
		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
		
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Spinnaker:400,700|Droid+Serif:400,700', array(), CHILD_THEME_VERSION );
		
	}
	
	//* Enqueue Backstretch script and prepare images for loading
	add_action( 'wp_enqueue_scripts', 'maidive_enqueue_backstretch_scripts' );
	function maidive_enqueue_backstretch_scripts() {
	
		$image = get_option( 'maidive-backstretch-image', sprintf( '%s/images/bg.jpg', get_stylesheet_directory_uri() ) );
		
		//* Load scripts only if custom backstretch image is being used
		if ( ! empty( $image ) ) {
	
			wp_enqueue_script( 'maidive-backstretch', get_bloginfo( 'stylesheet_directory' ) . '/js/backstretch.js', array( 'jquery' ), '1.0.0' );
			wp_enqueue_script( 'maidive-backstretch-set', get_bloginfo( 'stylesheet_directory' ).'/js/backstretch-set.js' , array( 'jquery', 'maidive-backstretch' ), '1.0.0' );
	
			wp_localize_script( 'maidive-backstretch-set', 'BackStretchImg', array( 'src' => str_replace( 'http:', '', $image ) ) );
		
		}
	
	}
	
	//* Add new image sizes
	add_image_size( 'home-bottom', 380, 150, TRUE );
	add_image_size( 'home-middle', 380, 380, TRUE );
	
	//* Add support for custom background
	add_theme_support( 'custom-background' ); 
	
	//* Add support for custom header
	add_theme_support( 'custom-header', array(
		'header_image'    => '',
		'header-selector' => '.site-title a',
		'header-text'     => false,
		'height'          => 150,
		'width'           => 185,
	) );
	
	//* Add support for 3-column footer widgets
	add_theme_support( 'genesis-footer-widgets', 1 );
	
	//* Add support for after entry widget
	add_theme_support( 'genesis-after-entry-widget-area' );
	
	//* Reposition the header
	remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
	remove_action( 'genesis_header', 'genesis_do_header' );
	remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
	add_action( 'genesis_before', 'genesis_header_markup_open', 5 );
	add_action( 'genesis_before', 'genesis_do_header', 10 );
	add_action( 'genesis_before', 'genesis_header_markup_close', 15 );
	
	//* Reposition the primary navigation menu
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	//add_action( 'genesis_header_right', 'genesis_do_nav' );
	
	//* Reposition the secondary navigation menu
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	//add_action( 'genesis_footer', 'genesis_do_subnav', 7 );
	
	//* Remove the entry meta in the entry header
	//remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	//remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	
	//* Customize the post info function
	add_filter( 'genesis_post_info', 'maidive_post_info_filter' );
	function maidive_post_info_filter($post_info) {
	
		$post_info = '[post_date] [post_categories before=""]';
		return $post_info;
	}
	
	//* Remove the entry footer markup (requires HTML5 theme support)
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

	
	//* Reduce the secondary navigation menu to one level depth
	add_filter( 'wp_nav_menu_args', 'maidive_secondary_menu_args' );
	function maidive_secondary_menu_args( $args ){
	
		if( 'secondary' != $args['theme_location'] )
		return $args;
	
		$args['depth'] = 1;
		return $args;
	
	}
	
	// watch video button
	add_action('genesis_after','maidive_watch_video');
	function maidive_watch_video() {
		genesis_widget_area( 'watch-video', array(
			'before' => '<div class="watch-video">',
			'after'  => '</div>',
		) );
	}
	
	//* Relocate after entry widget
	remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
	add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );
	
	//* Register widget areas
	genesis_register_sidebar( array(
		'id'          => 'home-top',
		'name'        => __( 'Home Top', 'maidive' ),
		'description' => __( 'This is the top section of the homepage.', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'home-middle',
		'name'        => __( 'Home Middle', 'maidive' ),
		'description' => __( 'This is the middle section of the homepage.', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'watch-video',
		'name'        => __( 'Watch Video', 'maidive' ),
	) );
	
	//* Custom functions
	//------------------------------------------------------------------------------------------------------
	
	//* Favicon
	require_once( trailingslashit( get_stylesheet_directory() ) . '/lib/maidive-favicon.php' );
	
	//* Footer
	require_once( trailingslashit( get_stylesheet_directory() ) . '/lib/maidive-footer.php' );
	
	//* Login logo
	require_once( trailingslashit( get_stylesheet_directory() ) . '/lib/maidive-login-logo.php' );
	
	//* Unregister Genesis specific functions, page layouts, and page templates
	require_once( trailingslashit( get_stylesheet_directory() ) . '/lib/genesis-unregister-functions.php' );

}