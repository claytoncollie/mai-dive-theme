<?php
// Add custom login page logo
//-----------------------------------------------------------------------------------------------------------
add_action( 'login_enqueue_scripts', 'sm_login_logo' );
function sm_login_logo() { 
	?>
		<style type="text/css">
            .login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/login-logo.png);
                padding-bottom: 50px;
                background-size: 100%;
                width: 100%;
                height: 100%;
            }
        </style>
	<?php }
