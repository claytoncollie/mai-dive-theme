<?php
/**
 * Functions
 *
 * @package      Mai Dive Theme
 * @author       Clayton Collie <clayton.collie@gmail.com>
 * @copyright    Copyright (c) 2015, Mai Dive Astrolabe Reef Resort
 */

// Start the engine (do not remove).
require_once get_template_directory() . '/lib/init.php';

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Mai Dive Theme' );
define( 'CHILD_THEME_URL', 'https://www.maidive.com' );
define( 'CHILD_THEME_VERSION', '4.0.0' );

// Set Localization (do not remove).
load_child_theme_textdomain( 'maidive', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'maidive' ) );

// Includes (do not remove).
require_once get_stylesheet_directory() . '/lib/theme-support.php';
require_once get_stylesheet_directory() . '/lib/genesis.php';
require_once get_stylesheet_directory() . '/lib/scripts.php';
require_once get_stylesheet_directory() . '/lib/images.php';
require_once get_stylesheet_directory() . '/lib/copyright.php';
require_once get_stylesheet_directory() . '/lib/simple-social-icons.php';

// https://www.resbook.co.nz/art/guests/?pid=1918&amp;pmpid=&amp;availability=show&amp;iframe=1&amp;center=true
