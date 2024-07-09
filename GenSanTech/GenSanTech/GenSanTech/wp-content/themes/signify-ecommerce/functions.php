<?php
/*
 * This is the child theme for Signify theme.
 */

/**
 * Enqueue default CSS styles
 */
function signify_ecommerce_enqueue_styles() {
	// Include parent theme CSS.
    wp_enqueue_style( 'signify-style', get_template_directory_uri() . '/style.css', null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

    // Include child theme CSS.
    wp_enqueue_style( 'signify-ecommerce-style', get_stylesheet_directory_uri() . '/style.css', array( 'signify-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/style.css' ) ) );

    // Load rtl css.
	if ( is_rtl() ) {
		wp_enqueue_style( 'signify-rtl', get_template_directory_uri() . '/rtl.css', array( 'signify-style' ), filemtime( get_stylesheet_directory() . '/rtl.css' ) );
	}

	// Enqueue child block styles after parent block style.
	wp_enqueue_style( 'signify-ecommerce-block-style', get_stylesheet_directory_uri() . '/assets/css/child-blocks.css', array( 'signify-block-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-blocks.css' ) ) );
}
add_action( 'wp_enqueue_scripts', 'signify_ecommerce_enqueue_styles' );

/**
 * Initialize theme codes.
 */
function signify_ecommerce_editor_style() {
	// Add child theme editor styles.
	add_editor_style( array(
			'assets/css/child-editor-style.css',
			signify_fonts_url(),
			get_theme_file_uri( 'assets/css/font-awesome/css/font-awesome.css' ),
		)
	);

	// Add Top Menu.
	register_nav_menus(
		array(
			'menu-top' => esc_html__( 'Header Top Menu', 'signify-ecommerce' ),
		)
	);
}
add_action( 'after_setup_theme', 'signify_ecommerce_editor_style', 11 );

/**
 * Enqueue editor styles for Gutenberg
 */
function signify_ecommerce_block_editor_styles() {
	// Enqueue child block editor style after parent editor block css.
	wp_enqueue_style( 'signify-ecommerce-block-editor-style', get_stylesheet_directory_uri() . '/assets/css/child-editor-blocks.css', array( 'signify-block-editor-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-editor-blocks.css' ) ) );
}
add_action( 'enqueue_block_editor_assets', 'signify_ecommerce_block_editor_styles', 11 );

/**
 * Loads the child theme textdomain and update notifier.
 */
function signify_ecommerce_setup() {
    load_child_theme_textdomain( 'signify-ecommerce', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'signify_ecommerce_setup', 11 );

/**
 * Change default header image
 */
function signify_ecommerce_header_default_image( $args ) {
	$args['default-image']      = get_theme_file_uri( 'assets/images/header-image-ecommerce.jpg' );
	$args['default-text-color'] = '#ffffff';

	return $args;
}
add_filter( 'signify_custom_header_args', 'signify_ecommerce_header_default_image' );

/**
 * Add Header Layout Class to body class
 *
 * @since 1.0.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function signify_ecommerce_body_classes( $classes ) {
	// Added color scheme to body class.
	$classes['color-scheme'] = 'color-scheme-ecommerce';

	return $classes;
}
add_filter( 'body_class', 'signify_ecommerce_body_classes', 100 );

/**
 * Include Theme Options
 */
require get_theme_file_path( 'inc/customizer/theme-options.php' );

/**
 * Include woocommerce support.
 */
require get_theme_file_path( 'inc/customizer/woocommerce.php' );

/**
 * Include parent override functions.
 */
require get_theme_file_path( 'inc/override-parent.php' );
