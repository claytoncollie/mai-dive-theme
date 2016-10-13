<?php
/**
 * Functions
 *
 * @package      Mai Dive Child Theme
 * @since        2.0.0
 * @author       Clayton Collie <clayton.collie@gmail.com>
 * @copyright    Copyright (c) 2015, Mai Dive Astrolabe Reef Resort
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
add_action( 'genesis_setup', 'maidive_theme_setup', 15 );
function maidive_theme_setup() {
	//* Start the engine
	include_once( get_template_directory() . '/lib/init.php' );
	
	//* Set Localization (do not remove)
	load_child_theme_textdomain( 'maidive', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'maidive' ) );
	
	// Load customizer
	include_once( get_stylesheet_directory() . '/lib/customize.php' );

	//* Simple social share filters
	include_once( trailingslashit( get_stylesheet_directory() ) . '/lib/simple-social-share.php' );
	
	//* Child theme (do not remove)
	define( 'CHILD_THEME_NAME', __( 'Mai Dive Child Theme', 'maidive' ) );
	define( 'CHILD_THEME_URL', 'https://www.maidive.com' );
	define( 'CHILD_THEME_VERSION', '3.8.0' );
	
	//* Add HTML5 markup structure
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	
	//* Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );
	
	//* Enqueue Scripts
	add_action( 'wp_enqueue_scripts', 'maidive_load_scripts' );
	add_action( 'wp_enqueue_scripts', 'maidive_load_video_scripts' ); 
	
	//* Add new image sizes
	add_image_size( 'maidive_rectangle', 	2100, 717, TRUE );
	add_image_size( 'maidive_square', 		1200, 631, TRUE );
	add_image_size( 'maidive_backstretch', 	1600, 1000, TRUE );
	
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
	
	// Mobile toolbar
	add_action('genesis_after','maidive_mobile_toolbar');
	
	// Blog specific actions
	add_action( 'genesis_meta', 'maidive_blog_genesis_meta' );
	
	//https://www.resbook.co.nz/art/guests/?pid=1918&amp;pmpid=&amp;availability=show&amp;iframe=1&amp;center=true

	//* Register widget areas
	//--------------------------------------------------------------------------------------------
	genesis_register_sidebar( array(
		'id'          => 'watch-video',
		'name'        => __( 'Watch Video', 'maidive' ),
	) );
	genesis_register_sidebar( array(
		'id'          => 'mobile-toolbar',
		'name'        => __( 'Mobile Toolbar', 'maidive' ),
	) );

	// Genesis Unregister functions
	//-----------------------------------------------------------------------------------------------

	//* Unregister content/sidebar layout setting
	//* genesis_unregister_layout( 'content-sidebar' );

	//* Unregister sidebar/content layout setting
	genesis_unregister_layout( 'sidebar-content' );

	//* Unregister content/sidebar/sidebar layout setting
	genesis_unregister_layout( 'content-sidebar-sidebar' );

	//* Unregister sidebar/sidebar/content layout setting
	genesis_unregister_layout( 'sidebar-sidebar-content' );

	//* Unregister sidebar/content/sidebar layout setting
	genesis_unregister_layout( 'sidebar-content-sidebar' );

	//* Unregister full-width content layout setting
	//* genesis_unregister_layout( 'full-width-content' );

	// Remove page templates
	add_filter( 'theme_page_templates', 'be_remove_genesis_page_templates' );

	//Remove genesis script support
	remove_post_type_support( 'post', 'genesis-scripts' );	// Posts
	remove_post_type_support( 'page', 'genesis-scripts' );	// Pages

	//* Remove Genesis in-post SEO Settings
	remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );

	// Remove layout support on archive
	remove_theme_support( 'genesis-archive-layouts' );

	//* Remove Genesis Layout Settings
	remove_theme_support( 'genesis-inpost-layouts' );

	//* Remove the edit link
	add_filter ( 'genesis_edit_post_link' , '__return_false' );

	//* Unregister primary navigation menu
	add_theme_support( 'genesis-menus', array( 'secondary' => __( 'Secondary Navigation Menu', 'genesis' ) ) );

	//* Unregister secondary navigation menu
	add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );

	//* Unregister secondary sidebar
	unregister_sidebar( 'sidebar-alt' );
	
}

// Load scripts for all pages
function maidive_load_scripts() {
	wp_enqueue_script( 'modernizr', 		get_stylesheet_directory_uri() . '/js/modernizr.3.3.1.min.js', array( 'jquery' ), '3.3.1', true );
	wp_enqueue_script( 'jquery-ui-tabs', '', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'maidive-global-js', get_stylesheet_directory_uri() . '/js/global.min.js', array( 'jquery', 'jquery-ui-tabs', 'modernizr' ), CHILD_THEME_VERSION, true );

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,700|Roboto:400,700', array(), CHILD_THEME_VERSION );
}

//Load video scripts
function maidive_load_video_scripts() {
	
	$var_maidive_video_url_mp4 = get_field('maidive_video_url_mp4' );
	
	if( wp_is_mobile() && has_post_thumbnail() ) { 
		// if it is not mobile, has a thumbnail, and do not have any contents in the custom fields for videos, show the psot thumbnail
		wp_enqueue_script( 'maidive-backstretch', get_bloginfo( 'stylesheet_directory' ).'/js/backstretch.init.min.js',  array( 'jquery' ), CHILD_THEME_VERSION, true );	
		$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'maidive_backstretch' );
		$backstretch_src = array( 'src' => $featured_image_url );
		wp_localize_script( 'maidive-backstretch', 'BackStretchImg', $backstretch_src );
	
	}elseif( wp_is_mobile() && !has_post_thumbnail() ) {	
		// If it fails the first conditional by not having a post thumbnail, display default image from customizer
		wp_enqueue_script( 'maidive-backstretch', get_bloginfo( 'stylesheet_directory' ).'/js/backstretch.init.min.js',  array( 'jquery' ), CHILD_THEME_VERSION, true );
		$backstretch_src = array( 'src' => get_option( 'maidive-default-image') );
		wp_localize_script( 'maidive-backstretch', 'BackStretchImg', $backstretch_src );
	
	}elseif( has_post_thumbnail() && empty($var_maidive_video_url_mp4) ) { 
		// if it is not mobile, has a thumbnail, and do not have any contents in the custom fields for videos, show the psot thumbnail
		wp_enqueue_script( 'maidive-backstretch', get_bloginfo( 'stylesheet_directory' ).'/js/backstretch.init.min.js',  array( 'jquery' ), CHILD_THEME_VERSION, true );		
		$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'maidive_backstretch'  );
		$backstretch_src = array( 'src' => $featured_image_url );
		wp_localize_script( 'maidive-backstretch', 'BackStretchImg', $backstretch_src );
		
	}elseif( !empty($var_maidive_video_url_mp4) ){
		// Show video if custom fields are set on individual pages
		wp_enqueue_script( 'bigvideo-init', get_stylesheet_directory_uri() . '/js/bigvideo.init.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
		$bigvideo_mp4 = $var_maidive_video_url_mp4;
		wp_localize_script( 'bigvideo-init', 'BigVideoLocalizeMp4', $bigvideo_mp4 );
	}else{
		//If no videos or post thumbnails are present, use default video set in customizer
		wp_enqueue_script( 'bigvideo-init', get_stylesheet_directory_uri() . '/js/bigvideo.init.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
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

// Mobile toolbar from widget area
function maidive_mobile_toolbar() {
	genesis_widget_area( 'mobile-toolbar', array(
		'before' => '<div class="mobile-toolbar">',
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
			$post_info = '[post_date]';
			return $post_info;
		}
				
		//* Remove the entry meta in the entry header
		add_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		
	}	
}

//* Customize the footer
add_filter( 'genesis_footer_output', 'maidive_footer_creds_filter' );
function maidive_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] All Rights Reserved';
	$site_title = get_bloginfo('name');
	$login = do_shortcode( '[footer_loginout]' );
	return '<div class="credits">'.$creds.'<span style="margin: 0 10px;">|</span>'.$site_title.'<span style="margin: 0 10px;">|</span>'.$login.'</div>';
}

/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function be_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}