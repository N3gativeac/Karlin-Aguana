<?php
/**
 * OneStore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ====================================================
 * Theme constants
 * ====================================================
 */

define( 'ONESTORE_INCLUDES_DIR', get_template_directory() . '/inc' );
define( 'ONESTORE_IMAGES_URL', get_template_directory_uri() . '/assets/images' );
define( 'ONESTORE_CSS_URL', get_template_directory_uri() . '/assets/css' );
define( 'ONESTORE_FRONT_URL', get_template_directory_uri() . '/assets/fonts' );
define( 'ONESTORE_JS_URL', get_template_directory_uri() . '/assets/js' );
define( 'ONESTORE_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );
define( 'ONESTORE_ASSETS_SUFFIX', SCRIPT_DEBUG ? '' : '.min' );
define( 'ONESTORE_PLUS_URL', esc_url( 'https://sainwp.com/plus-upgrade/?utm_source=theme&utm_medium=dashboard&utm_campaign=customizer' ) );

/**
 * ====================================================
 * Main theme class
 * ====================================================
 */

require_once ONESTORE_INCLUDES_DIR . '/class-onestore.php';



