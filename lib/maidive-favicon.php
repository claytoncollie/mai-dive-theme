<?php


//* Display a custom favicon
add_filter( 'genesis_pre_load_favicon', 'maidive_favicon_filter' );
function maidive_favicon_filter( $favicon_url ) {
	return get_stylesheet_directory_uri() . '/images/favicon.ico';
}