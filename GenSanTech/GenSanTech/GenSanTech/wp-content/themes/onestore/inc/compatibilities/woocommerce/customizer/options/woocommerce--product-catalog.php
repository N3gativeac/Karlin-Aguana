<?php
/**
 * Customizer settings: WooCommerce > Shop (Products Catalog) Page
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'woocommerce_product_catalog';

/**
 * ====================================================
 * Layout
 * ====================================================
 */

// Heading: Layout
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_woocommerce_index_grid',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Layout', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Loop posts per page.
$key = 'woocommerce_index_posts_per_page';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'number' ),
	)
);

$wp_customize->add_control(
	new OneStore_Customize_Control_Slider(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Max products per page', 'onestore' ),
			'description' => esc_html__( 'Empty / 0 = disabled; -1 = Show all.', 'onestore' ),
			'units'       => array(
				'' => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
					'label' => 'col',
				),
			),
			'priority'    => 20,
		)
	)
);


// Loop columns.
$key = 'woocommerce_index_grid_columns';
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
		'label'       => esc_html__( 'Grid columns', 'onestore' ),
		'description' => esc_html__( 'Use commas to separate values for desktop, tablet and mobile.', 'onestore' ),
		'units'       => array(
			'' => array(
				'min'  => 1,
				'max'  => 6,
				'step' => 1,
				'label' => 'col',
			),
		),
		'priority'    => 20,
	)
);



// ------
$wp_customize->add_control(
	new OneStore_Customize_Control_HR(
		$wp_customize,
		'hr_woocommerce_index_elements',
		array(
			'section'     => $section,
			'settings'    => array(),
			'priority'    => 20,
		)
	)
);

// Use Ajax load more.
$key = 'woocommerce_ajax_more';
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
			'label'       => esc_html__( 'Enable AJAX load products', 'onestore' ),
			'priority'    => 20,
		)
	)
);

$key = 'woocommerce_ajax_filter';
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
			'label'       => esc_html__( 'Enable Filter', 'onestore' ),
			'priority'    => 20,
		)
	)
);


// Show products count.
$key = 'woocommerce_index_results_count';
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
			'label'       => esc_html__( 'Show products count', 'onestore' ),
			'priority'    => 20,
		)
	)
);



// Rows gutter.
$key = 'woocommerce_products_grid_rows_gutter';
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
			'label'       => esc_html__( 'Rows gutter', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'max'  => 40,
					'step' => 1,
				),
				'em' => array(
					'min'  => 0,
					'max'  => 3,
					'step' => 0.05,
				),
			),
			'priority'    => 30,
		)
	)
);

// Columns gutter.
$key = 'woocommerce_products_grid_columns_gutter';
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
			'label'       => esc_html__( 'Columns gutter', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'max'  => 40,
					'step' => 1,
				),
				'em' => array(
					'min'  => 0,
					'max'  => 3,
					'step' => 0.05,
				),
			),
			'priority'    => 40,
		)
	)
);

// Loop posts per page.
$key = 'woocommerce_index_thumb_height';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
		'transport'   => 'postMessage',
	)
);

$wp_customize->add_control(
	new OneStore_Customize_Control_Slider(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Thumbnail Height', 'onestore' ),
			'units'       => array(
				'%' => array(
					'min'  => 0,
					'max'  => 450,
					'step' => 1,
				),
				'px' => array(
					'min'  => 0,
					'max'  => 400,
					'step' => 1,
				),
			),
			'priority'    => 45,
		)
	)
);

