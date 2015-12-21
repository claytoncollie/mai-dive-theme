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
	
	// Load customizer
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
	
	//* Add new image sizes
	add_image_size( 'archive-thumbnail', 475, 130, TRUE );
	
	// Add layout support for custom post type
	add_post_type_support( 'maidive_gallery', array('genesis-layouts') );
	
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
	
	//* Relocate after entry widget
	remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
	add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );
	
	//* Reposition the primary navigation menu
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	
	//* Reposition the secondary navigation menu
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	
	//* Remove the entry meta in the entry header
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	
	//* Remove the entry footer markup (requires HTML5 theme support)
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
	
	// watch video button
	add_action('genesis_after','maidive_watch_video');
	
	// Blog specific actions
	add_action( 'genesis_meta', 'maidive_blog_genesis_meta' );
	
	//* Add featured image in archive view Entry Content above Excerpt
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	add_action( 'genesis_entry_header', 'maidive_featured_image', 8 );

	//* Register widget areas
	//--------------------------------------------------------------------------------------------
	//genesis_register_sidebar( array(
		//'id'          => 'home-top',
		//'name'        => __( 'Home Top', 'maidive' ),
		//'description' => __( 'This is the top section of the homepage.', 'maidive' ),
	//) );
	genesis_register_sidebar( array(
		'id'          => 'home-top-left',
		'name'        => __( 'Home Top Left', 'maidive' ),
		'description' => __( 'This is the top left section of the homepage. 2/3rds wide', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'home-top-right',
		'name'        => __( 'Home Top Right', 'maidive' ),
		'description' => __( 'This is the top right section of the homepage. 1/3rd wide', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'home-middle',
		'name'        => __( 'Home Middle', 'maidive' ),
		'description' => __( 'This is the middle section of the homepage.', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'sidebar-awards',
		'name'        => __( 'Sidebar - Awards', 'maidive' ),
		'description' => __( 'Sidebar to put on reviews template.', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'sidebar-adventures',
		'name'        => __( 'Sidebar - Adventures', 'maidive' ),
		'description' => __( 'Sidebar for single page templates associated with Adventures custom post type.', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'sidebar-accomodations',
		'name'        => __( 'Sidebar - Accomodations', 'maidive' ),
		'description' => __( 'Sidebar for single page templates associated with Accomodations custom post type.', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'sidebar-gallery',
		'name'        => __( 'Sidebar - Gallery', 'maidive' ),
		'description' => __( 'Sidebar for single page templates associated with Gallery custom post type.', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'sidebar-courses',
		'name'        => __( 'Sidebar - Courses', 'maidive' ),
		'description' => __( 'Sidebar for single page templates associated with Courses custom post type.', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'sidebar-landing',
		'name'        => __( 'Sidebar - Landing Page', 'maidive' ),
		'description' => __( 'Sidebar for landing page template.', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'header-right-landing',
		'name'        => __( 'Header Right - Landing Page', 'maidive' ),
		'description' => __( 'Header right area for custom menu for landing page template.', 'maidive' ),
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
	
	//* Simple social share filters
	require_once( get_stylesheet_directory() . '/lib/simple-social-share.php' );
	
	//* Genesis schema helper functions
	require_once( get_stylesheet_directory() . '/lib/genesis-schema-helper-functions.php' );
	
	// Call schema filters
	add_filter( 'genesis_attr_entry', 'maidive_schema_hotel', 20 );
	add_filter( 'genesis_attr_entry-title', 'maidive_itemprop_name', 20 );
	add_filter( 'genesis_attr_entry-content', 'maidive_itemprop_description', 20 );
	add_filter( 'genesis_post_title_output', 'maidive_title_link_schema', 20 );
	add_filter( 'genesis_attr_content', 'maidive_schema_empty', 20 );

}

// Load scripts for all pages
function maidive_load_scripts() {
	
	wp_enqueue_script( 'maidive-global-js', get_bloginfo( 'stylesheet_directory' ) . '/js/global.min.js', array( 'jquery' ), '1.0.0', false );
	
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Spinnaker:400,700|Droid+Serif:400,700', array(), CHILD_THEME_VERSION );
	
	$var_maidive_video_url_mp4 = get_field('maidive_video_url_mp4' );
	
	if( is_mobile() && has_post_thumbnail() ) { 
		
		// if it is not mobile, has a thumbnail, and do not have any contents in the custom fields for videos, show the psot thumbnail
		wp_enqueue_script( 'maidive-backstretch-init', get_bloginfo( 'stylesheet_directory' ).'/js/backstretch-init.js', '', '1.0.0', false );	
		$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
		$backstretch_src = array( 'src' => $featured_image_url );
		wp_localize_script( 'maidive-backstretch-init', 'BackStretchImg', $backstretch_src );
	
	}elseif( is_mobile() && !has_post_thumbnail() ) {	
		
		// If it fails the first conditional by not having a post thumbnail, display default image from customizer
		wp_enqueue_script( 'maidive-backstretch-init', get_bloginfo( 'stylesheet_directory' ).'/js/backstretch-init.js', '', '1.0.0', false );
		$backstretch_src = array( 'src' => get_option( 'maidive-backstretch-image') );
		wp_localize_script( 'maidive-backstretch-init', 'BackStretchImg', $backstretch_src );
	
	}elseif( has_post_thumbnail() && empty($var_maidive_video_url_mp4) ) { 
		
		// if it is not mobile, has a thumbnail, and do not have any contents in the custom fields for videos, show the psot thumbnail
		wp_enqueue_script( 'maidive-backstretch-init', get_bloginfo( 'stylesheet_directory' ).'/js/backstretch-init.js', '', '1.0.0', false );		
		$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
		$backstretch_src = array( 'src' => $featured_image_url );
		wp_localize_script( 'maidive-backstretch-init', 'BackStretchImg', $backstretch_src );
		
	}elseif( !empty($var_maidive_video_url_mp4) && !is_post_type_archive() ){
		
		wp_enqueue_script( 'bigvideo-init', get_stylesheet_directory_uri() . '/js/bigvideo-init.js', '', '1.0.0', false );
		
		// Show video if custom fields are set on individual pages
		$bigvideo_mp4 = $var_maidive_video_url_mp4;
		wp_localize_script( 'bigvideo-init', 'BigVideoLocalizeMp4', $bigvideo_mp4 );

		
	}elseif( !is_post_type_archive() ){
		
		wp_enqueue_script( 'bigvideo-init', get_stylesheet_directory_uri() . '/js/bigvideo-init.js', '', '1.0.0', false );
		
		//If no videos or post thumbnails are present, use default video set in customizer
		$bigvideo_mp4 = get_option( 'maidive-background-video-mp4' );
		wp_localize_script( 'bigvideo-init', 'BigVideoLocalizeMp4', $bigvideo_mp4 );
		
	}

}

// Watch video button
function maidive_watch_video() {
	genesis_widget_area( 'watch-video', array(
		'before' => '<div class="watch-video">',
		'after'  => '</div>',
	) );
}

// Blog sidebars and post info
function maidive_blog_genesis_meta() {
	
	if ( is_singular('post') || is_home() || is_category() || is_tag() || is_date() || is_author() ) {

		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
		
		//* Customize the post info function
		add_filter( 'genesis_post_info', 'maidive_post_info_filter' );
		function maidive_post_info_filter($post_info) {
			$post_info = '[post_date] [post_categories before=""]';
			return $post_info;
		}
				
		//* Remove the entry meta in the entry header
		add_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		
		// Remove primary sidebar and replace with secondary sidebar
		remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
		add_action( 'genesis_sidebar', 'genesis_do_sidebar_alt' );
		
	}	
}

// Add featured image for specific size only in archive view, remove in all else
function maidive_featured_image() {

	if( is_archive() ) {
		
		$image_args = array(
			'size' => 'archive-thumbnail',
		);
	
		$image = genesis_get_image( $image_args );
	
		if ( $image ) {
			echo '<a href="' . get_permalink() . '">' . $image .'</a>';
		}
		
	}else{
		return;
	}

}