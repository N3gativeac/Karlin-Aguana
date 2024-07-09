<?php
/**
 * Customizer settings: WooCommerce > Single Product
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'woocommerce_product_single'; // Assumed.

/**
 * ====================================================
 * Layout
 * ====================================================
 */


/**
 * ====================================================
 * Images
 * ====================================================
 */

// Heading: Gallery.
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_woocommerce_single_gallery',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Gallery', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Show gallery.
$key = 'woocommerce_single_gallery';
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
			'label'       => esc_html__( 'Show gallery', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Gallery column width.
$key = 'woocommerce_single_gallery_width';
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
			'label'       => esc_html__( 'Gallery column Width', 'onestore' ),
			'units'       => array(
				'%' => array(
					'min'  => 25,
					'max'  => 75,
					'step' => 0.05,
				),
			),
			'priority'    => 20,
		)
	)
);

// Gallery column gap.
$key = 'woocommerce_single_gallery_gap';
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
			'label'       => esc_html__( 'Gap with summary column', 'onestore' ),
			'units'       => array(
				'%' => array(
					'min'  => 0,
					'max'  => 10,
					'step' => 1,
				),
				'px' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
			),
			'priority'    => 20,
		)
	)
);

// Enable zoom.
$key = 'woocommerce_single_gallery_zoom';
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
			'label'       => esc_html__( 'Enable zoom', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Enable lightbox.
$key = 'woocommerce_single_gallery_lightbox';
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
			'label'       => esc_html__( 'Enable lightbox', 'onestore' ),
			'priority'    => 20,
		)
	)
);

$key = 'woocommerce_single_wishlist';
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
			'label'       => esc_html__( 'Enable Wishlist', 'onestore' ),
			'description'       => esc_html__( 'You must enable wishlist plugin to use this function.', 'onestore' ),
			'priority'    => 20,
		)
	)
);


/**
 * ====================================================
 * Tabs
 * ====================================================
 */

// Heading: Tabs
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_woocommerce_single_tabs',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Content data', 'onestore' ),
			'priority'    => 40,
		)
	)
);

// Show tabs.
$key = 'woocommerce_single_tabs';
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
			'label'       => esc_html__( 'Show content data', 'onestore' ),
			'priority'    => 40,
		)
	)
);




// Elements to display.
// Heading: Up-Sells
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_woocommerce_single_more_sections',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'More Sections', 'onestore' ),
			'priority'    => 44,
		)
	)
);
$key = 'woocommerce_single_more_sections';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'multiselect' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Builder(
		$wp_customize,
		$key,
		array(
			'settings'    => $key,
			'section'     => $section,
			'label'       => esc_html__( 'More Sections', 'onestore' ),
			'choices'     => apply_filters(
				'onestore/woocommerce/single_more_elements',
				array(
					'up-sells' => esc_html__( 'Recommended', 'onestore' ),
					'related' => esc_html__( 'Related', 'onestore' ),
				)
			),
			'labels'      => array(
				'sections'    => esc_html__( 'Sections', 'onestore' ),
			),
			'layout'      => 'block',
			'priority'    => 60,
		)
	)
);


// Up-sells columns.
$key = 'woocommerce_single_more_grid_columns';
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
		'label'       => esc_html__( 'Columns', 'onestore' ),
		'priority'    => 70,
	)
);

// Related products posts per page
$key = 'woocommerce_single_more_posts_per_page';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'number' ),
	)
);
$wp_customize->add_control(
	$key,
	array(
		'type'        => 'number',
		'section'     => $section,
		'label'       => esc_html__( 'Max products shown', 'onestore' ),
		'description' => esc_html__( '0 = disabled; -1 = show all.', 'onestore' ),
		'input_attrs' => array(
			'min'  => -1,
			'max'  => 12,
			'step' => 1,
		),
		'priority'    => 80,
	)
);


/**
 * ====================================================
 * Tabs
 * ====================================================
 */

// Heading: Sticky Cart
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_woocommerce_single_sticky_cart',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Sticky add to cart', 'onestore' ),
			'priority'    => 85,
		)
	)
);

// Show sticky add to cart.
$key = 'woocommerce_single_sticky_cart';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'select' ),
	)
);
$wp_customize->add_control(
	$key,
	array(
		'section'     => $section,
		'label'       => esc_html__( 'Sticky add to cart', 'onestore' ),
		'priority'    => 90,
		'type'    => 'select',
		'choices' => array(
			'top' => esc_html__( 'Top', 'onestore' ),
			'bottom' => esc_html__( 'Bottom', 'onestore' ),
			'none' => esc_html__( 'Hide ', 'onestore' ),
		),
	)
);
