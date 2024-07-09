<?php
/**
 * Customizer settings: WooCommerce > Cart
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'woocommerce_cart'; // Assumed

/**
 * ====================================================
 * Layout
 * ====================================================
 */

// Heading: Layout
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_woocommerce_cart_layout',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Layout', 'onestore' ),
			'priority'    => 10,
		)
	)
);

// Layout
$key = 'woocommerce_cart_layout';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'select' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_RadioImage(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Layout', 'onestore' ),
			'choices'     => array(
				'default' => array(
					'label' => esc_html__( 'Default', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/woocommerce-cart-layout--default.svg',
				),
				'2-columns' => array(
					'label' => esc_html__( '2 Columns', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/woocommerce-cart-layout--2-columns.svg',
				),
			),
			'priority'    => 10,
		)
	)
);


// Cart Max Width
$key = 'woocommerce_cart_width';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Slider(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Cart max width', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'max'  => 1400,
					'step' => 1,
				),
			),
			'priority'    => 15,
		)
	)
);

// ------
$wp_customize->add_control(
	new OneStore_Customize_Control_HR(
		$wp_customize,
		'hr_woocommerce_cart_cross_sells',
		array(
			'section'     => $section,
			'settings'    => array(),
			'priority'    => 20,
		)
	)
);

// Cross-sells.
$key = 'woocommerce_cart_cross_sells';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'toggle' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Toggle(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Show cross-sells', 'onestore' ),
			'description' => esc_html__( 'Display cross-sells as configured on Edit Product page > Product Data > Linked Products > Cross-sells.', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Cross-sells grid columns
$key = 'woocommerce_cart_cross_sells_grid_columns';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'text' ),
	)
);
$wp_customize->add_control(
	$key,
	array(
		'section'     => $section,
		'label'       => esc_html__( 'Cross-sells grid columns', 'onestore' ),
		'priority'    => 20,
	)
);

