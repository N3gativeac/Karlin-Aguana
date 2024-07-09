<?php
/**
 * @package Physiotherapy Lite
 * Setup the WordPress core custom header feature.
 *
 * @uses physiotherapy_lite_header_style()
*/
function physiotherapy_lite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'physiotherapy_lite_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'flex-width'             => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'physiotherapy_lite_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'physiotherapy_lite_custom_header_setup' );

if ( ! function_exists( 'physiotherapy_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see physiotherapy_lite_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'physiotherapy_lite_header_style' );

function physiotherapy_lite_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        .page-template-custom-home-page .middle-header, .middle-header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'physiotherapy-lite-basic-style', $custom_css );
	endif;
}
endif;