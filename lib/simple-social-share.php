<?php 

//* Custom Simple Share Plugin Filter
//------------------------------------------------------------------------------------------------------

add_filter( 'simple_social_default_profiles', 'maidive_simple_social_default_profiles' );
function maidive_simple_social_default_profiles() {
	$glyphs = array(
			'tripadvisor' => '<span class="fa fa-tripadvisor"></span>',
			'email'       => '<span class="fa fa-envelope"></span>',
			'facebook'    => '<span class="fa fa-facebook"></span>',
			'flickr'      => '<span class="fa fa-flickr"></span>',
			'gplus'       => '<span class="fa fa-google-plus"></span>',
			'instagram'   => '<span class="fa fa-instagram"></span>',
			'linkedin'    => '<span class="fa fa-linkedin"></span>',
			'pinterest'   => '<span class="fa fa-pinterest"></span>',
			'rss'         => '<span class="fa fa-rss"></span>',
			'tumblr'      => '<span class="fa fa-tumblr"></span>',
			'twitter'     => '<span class="fa fa-twitter"></span>',
			'vimeo'       => '<span class="fa fa-vimeo-square"></span>',
			'yelp'        => '<span class="fa fa-yelp"></span>',
			'youtube'     => '<span class="fa fa-youtube"></span>',
		);

	$profiles = array(

			'tripadvisor' => array(
				'label'   => __( 'Trip Advisor URI', 'ssiw' ),
				'pattern' => '<li class="social-tripadvisor"><a href="%s" %s>' . $glyphs['tripadvisor'] . '</a></li>',
			),
			'email' => array(
				'label'   => __( 'Email URI', 'ssiw' ),
				'pattern' => '<li class="social-email"><a href="%s" %s>' . $glyphs['email'] . '</a></li>',
			),
			'facebook' => array(
				'label'   => __( 'Facebook URI', 'ssiw' ),
				'pattern' => '<li class="social-facebook"><a href="%s" %s>' . $glyphs['facebook'] . '</a></li>',
			),
			'flickr' => array(
				'label'   => __( 'Flickr URI', 'ssiw' ),
				'pattern' => '<li class="social-flickr"><a href="%s" %s>' . $glyphs['flickr'] . '</a></li>',
			),

			'gplus' => array(
				'label'   => __( 'Google+ URI', 'ssiw' ),
				'pattern' => '<li class="social-gplus"><a href="%s" %s>' . $glyphs['gplus'] . '</a></li>',
			),
			'instagram' => array(
				'label'   => __( 'Instagram URI', 'ssiw' ),
				'pattern' => '<li class="social-instagram"><a href="%s" %s>' . $glyphs['instagram'] . '</a></li>',
			),
			'linkedin' => array(
				'label'   => __( 'Linkedin URI', 'ssiw' ),
				'pattern' => '<li class="social-linkedin"><a href="%s" %s>' . $glyphs['linkedin'] . '</a></li>',
			),
			'pinterest' => array(
				'label'   => __( 'Pinterest URI', 'ssiw' ),
				'pattern' => '<li class="social-pinterest"><a href="%s" %s>' . $glyphs['pinterest'] . '</a></li>',
			),
			'rss' => array(
				'label'   => __( 'RSS URI', 'ssiw' ),
				'pattern' => '<li class="social-rss"><a href="%s" %s>' . $glyphs['rss'] . '</a></li>',
			),
			'tumblr' => array(
				'label'   => __( 'Tumblr URI', 'ssiw' ),
				'pattern' => '<li class="social-tumblr"><a href="%s" %s>' . $glyphs['tumblr'] . '</a></li>',
			),
			'twitter' => array(
				'label'   => __( 'Twitter URI', 'ssiw' ),
				'pattern' => '<li class="social-twitter"><a href="%s" %s>' . $glyphs['twitter'] . '</a></li>',
			),
			'vimeo' => array(
				'label'   => __( 'Vimeo URI', 'ssiw' ),
				'pattern' => '<li class="social-vimeo"><a href="%s" %s>' . $glyphs['vimeo'] . '</a></li>',
			),
			'yelp' => array(
				'label'   => __( 'Yelp URI', 'ssiw' ),
				'pattern' => '<li class="social-yelp"><a href="%s" %s>' . $glyphs['yelp'] . '</a></li>',
			),
			'youtube' => array(
				'label'   => __( 'YouTube URI', 'ssiw' ),
				'pattern' => '<li class="social-youtube"><a href="%s" %s>' . $glyphs['youtube'] . '</a></li>',
			),

		);
	return $profiles;
}