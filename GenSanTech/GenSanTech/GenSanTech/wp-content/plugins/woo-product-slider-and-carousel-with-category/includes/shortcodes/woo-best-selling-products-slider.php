<?php
/**
 * shortcode [bestselling_products_slider]
 *
 * @package Woo Product Slider and Carousel with category
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Action for shortcode
 *
 * @package Woo Product Slider and Carousel with category
 * @since 1.0
 */
function wcpscwc_bestselling_products_slider( $atts, $content ) {

	$atts	= is_array( $atts ) ? $atts : array();
	$atts['type'] = 'bestselling';

	$result = wcpscwc_product_slider( $atts, $content );

	if( is_user_logged_in() && current_user_can('manage_options') ) {
		$notice = '<div class="wcpscwc-deprecated">This shortcode is deprecated since version 2.5 and will be removed in future. Kindly use <b>wcpscwc_pdt_slider</b> for slider shortcode instead of this or check plugin <a href="https://docs.wponlinesupport.com/woo-product-slider-and-carousel-with-category/" target="_blank">documentation</a> for more help.</div>';
		return $notice . $result;
	}
}

// Add Shortcode Best Selling Product
add_shortcode( 'bestselling_products_slider', 'wcpscwc_bestselling_products_slider' );