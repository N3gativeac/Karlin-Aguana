<?php
/**
 * @package Appointment Booking
 * Setup the WordPress core custom header feature.
 *
 * @uses appointment_booking_header_style()
*/
function appointment_booking_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'appointment_booking_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1400,
		'height'                 => 202,
		'flex-width'    		 => true,
		'flex-height'    		 => true,
		'wp-head-callback'       => 'appointment_booking_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'appointment_booking_custom_header_setup' );

if ( ! function_exists( 'appointment_booking_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see appointment_booking_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'appointment_booking_header_style' );

function appointment_booking_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        .home-page-header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'appointment-booking-basic-style', $custom_css );
	endif;
}
endif;