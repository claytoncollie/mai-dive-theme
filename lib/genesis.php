<?php
/**
 * Genesis Support
 *
 * @package      Mai Dive Theme
 * @author       Clayton Collie <clayton.collie@gmail.com>
 * @copyright    Copyright (c) 2015, Mai Dive Astrolabe Reef Resort
 */

// Relocate after entry widget.
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

// Remove the entry meta in the entry header.
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// Remove the entry footer markup (requires HTML5 theme support).
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

// Remove the entry meta in the entry header.
add_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// Unregister sidebar/content layout setting.
genesis_unregister_layout( 'sidebar-content' );

// Unregister content/sidebar/sidebar layout setting.
genesis_unregister_layout( 'content-sidebar-sidebar' );

// Unregister sidebar/sidebar/content layout setting.
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Unregister sidebar/content/sidebar layout setting.
genesis_unregister_layout( 'sidebar-content-sidebar' );

// Remove genesis script support.
remove_post_type_support( 'post', 'genesis-scripts' );
remove_post_type_support( 'page', 'genesis-scripts' );

// Remove Genesis in-post SEO Settings.
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );

// Remove the edit link.
add_filter( 'genesis_edit_post_link', '__return_false' );

// Unregister secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

add_filter( 'genesis_post_info', 'maidive_get_the_post_info' );
/**
 * Customize the post info to only show the date.
 *
 * @param string $post_info Post info.
 * @return string
 */
function maidive_get_the_post_info( string $post_info ) : string {
	$post_info = '[post_date]';
	return $post_info;
}

add_filter( 'theme_page_templates', 'maidive_remove_genesis_page_templates' );
/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates Page Templates.
 * @return array
 */
function maidive_remove_genesis_page_templates( array $page_templates ) : array {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
