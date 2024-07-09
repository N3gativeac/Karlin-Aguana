<?php
/**
 * Customizer settings: Header > Search
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_header_search';

/**
 * ====================================================
 * Search Bar
 * ====================================================
 */

// Heading: Search Bar
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_header_search_bar',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Search Bar', 'onestore' ),
			'priority'    => 10,
		)
	)
);

// Search bar width.
$key = 'header_search_bar_width';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Dimension(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Bar width', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'   => 100,
					'step'  => 1,
				),
				'%' => array(
					'min'   => 100,
					'step'  => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

/**
 * ====================================================
 * Search Dropdown
 * ====================================================
 */

// Heading: Search Dropdown.
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_header_search_dropdown',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Search Dropdown', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Search bar width.
$key = 'header_search_dropdown_width';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Dimension(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Dropdown width', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'   => 100,
					'step'  => 1,
				),
			),
			'priority'    => 20,
		)
	)
);


/**
 * ====================================================
 * Search WC Products
 * ====================================================
 */

 // Heading: Search Products.
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_header_search_advanced',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Advanced', 'onestore' ),
			'priority'    => 50,
		)
	)
);



if ( function_exists( 'WC' ) ) {

	$key = 'heading_header_search_product_only';
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
				'label'       => esc_html__( 'Search Products Only', 'onestore' ),
				'priority'    => 60,
			)
		)
	);

	$key = 'heading_header_search_product_cat';
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
				'label'       => esc_html__( 'Enable Product Categories', 'onestore' ),
				'priority'    => 60,
			)
		)
	);
}


