<?php
/**
 * Customizer settings: Header > Mobile Main Bar
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_header_mobile_main_bar';

/**
 * ====================================================
 * Layout
 * ====================================================
 */

// Height.
$key = 'header_mobile_main_bar_height';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Slider(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Height', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'   => 20,
					'max'   => 150,
					'step'  => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

// Enable Page Header.
$key = 'header_mobile_main_bar_sticky';
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
			'label'       => esc_html__( 'Enable Sticky', 'onestore' ),
			'priority'    => 10,
		)
	)
);


// Padding.
$key = 'header_mobile_main_bar_padding';
$settings = array(
	$key . '__tablet',
	$key . '__mobile',
);
foreach ( $settings as $setting ) {
	$wp_customize->add_setting(
		$setting,
		array(
			'default'     => onestore_array_value( $defaults, $setting ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimensions' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Dimensions(
		$wp_customize,
		$key,
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Padding', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'step' => 1,
				),
				'em' => array(
					'min'  => 0,
					'step' => 0.05,
				),
				'%' => array(
					'min'  => 0,
					'step' => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

// Border.
$key = 'header_mobile_main_bar_border';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimensions' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Dimensions(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Border', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'step' => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

// Items gutter.
$key = 'header_mobile_main_bar_items_gutter';
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
			'label'       => esc_html__( 'Spacing between elements', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'   => 0,
					'max'   => 40,
					'step'  => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

/**
 * ====================================================
 * Typography
 * ====================================================
 */

// Heading: Typography
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_header_mobile_main_bar_typography',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Typography', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Icon size
$key = 'header_mobile_main_bar_icon_size';
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
			'label'       => esc_html__( 'Icon size', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'max'  => 60,
					'step' => 1,
				),
			),
			'priority'    => 20,
		)
	)
);

/**
 * ====================================================
 * Colors
 * ====================================================
 */

// Heading: Colors
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_header_mobile_main_bar_colors',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Colors', 'onestore' ),
			'priority'    => 30,
		)
	)
);

// Colors
$colors = array(
	'header_mobile_main_bar_bg_color'              => esc_html__( 'Background color', 'onestore' ),
	'header_mobile_main_bar_border_color'          => esc_html__( 'Border color', 'onestore' ),
	'header_mobile_main_bar_link_text_color'       => esc_html__( 'Link text color', 'onestore' ),
	'header_mobile_main_bar_link_hover_text_color' => esc_html__( 'Link text color :hover', 'onestore' ),
);
foreach ( $colors as $key => $label ) {
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'color' ),
		)
	);
	$wp_customize->add_control(
		new OneStore_Customize_Control_Color(
			$wp_customize,
			$key,
			array(
				'section'     => $section,
				'label'       => $label,
				'priority'    => 30,
			)
		)
	);
}
