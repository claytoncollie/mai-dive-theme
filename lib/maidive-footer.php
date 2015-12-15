<?php
// FOOTER
//----------------------------------------------------------------------------------------
//* Customize the footer
add_filter( 'genesis_footer_output', 'maidive_footer_creds_filter' );
function maidive_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] All Rights Reserved';
	$site_title = get_bloginfo('name');
	$login = do_shortcode( '[footer_loginout]' );
	return '<div class="credits">'.$creds.'<span style="margin: 0 10px;">|</span>'.$site_title.'<span style="margin: 0 10px;">|</span>'.$login.'</div>';
}


