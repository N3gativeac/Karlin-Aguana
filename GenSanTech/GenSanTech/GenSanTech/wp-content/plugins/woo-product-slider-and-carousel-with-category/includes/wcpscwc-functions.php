<?php
/**
 * Plugin generic functions file
 *
 * @package Woo Product Slider and Carousel with category
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to unique number value
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.2.5
 */
function wcpscwc_get_unique() {
    static $unique = 0;
    $unique++;

    // For Elementor & Beaver Builder
	if( ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_POST['action'] ) && $_POST['action'] == 'elementor_ajax' )
	|| ( class_exists('FLBuilderModel') && ! empty( $_POST['fl_builder_data']['action'] ) )
	|| ( function_exists('vc_is_inline') && vc_is_inline() ) ) {
		$unique = current_time('timestamp') . '-' . rand();
	}

    return $unique;
}

/**
 * Sanitize number value and return fallback value if it is blank
 * 
 * @package Woo Product Slider and Carousel with Category
 * @since 2.5
 */
function wcpscwc_clean_number( $var, $fallback = null, $type = 'int' ) {

    if ( $type == 'number' ) {
        $data = intval( $var );
    } else {
        $data = absint( $var );
    }

    return ( empty( $data ) && isset( $fallback ) ) ? $fallback : $data;
}

/**
 * Sanitize Multiple HTML class
 * 
 * @package Woo Product Slider and Carousel with Category
 * @since 2.5
 */
function wcpscwc_sanitize_html_classes($classes, $sep = " ") {
    $return = "";

    if( ! is_array( $classes ) ) {
        $classes = explode($sep, $classes);
    }

    if( ! empty( $classes ) ) {
        foreach($classes as $class){
            $return .= sanitize_html_class($class) . " ";
        }
        $return = trim( $return );
    }

    return $return;
}

/**
 * Function to check woocommerce version
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.2.2
 */
function wcpscwc_wc_version( $version = '3.0', $operator = '>=' ) {
    global $woocommerce;

    $operator = ! empty( $operator ) ? $operator : '=';

    if( version_compare( $woocommerce->version, $version, $operator ) ) {
        return true;
    }
    return false;
}