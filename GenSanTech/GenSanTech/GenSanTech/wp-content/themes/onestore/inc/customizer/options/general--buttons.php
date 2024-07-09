<?php
/**
 * Customizer settings: General Styles > Button
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_button';

// Padding.
$key = 'button_padding';
$settings = array(
	$key,
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
			'section'     => $section,
			'settings'    => $settings,
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
			),
			'priority'    => 10,
		)
	)
);


// Padding.
$key = 'button_padding_sm';
$settings = array(
	$key,
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
			'section'     => $section,
			'settings'    => $settings,
			'label'       => esc_html__( 'Button Small Padding', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'step' => 1,
				),
				'em' => array(
					'min'  => 0,
					'step' => 0.05,
				),
			),
			'priority'    => 10,
		)
	)
);

$key = 'button_padding_lg';
$settings = array(
	$key,
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
			'section'     => $section,
			'settings'    => $settings,
			'label'       => esc_html__( 'Button Large Padding', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'step' => 1,
				),
				'em' => array(
					'min'  => 0,
					'step' => 0.05,
				),
			),
			'priority'    => 10,
		)
	)
);

// Border
$key = 'button_border';
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

// Border radius
$key = 'button_border_radius';
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
			'label'       => esc_html__( 'Border radius', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'max'  => 40,
					'step' => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

// ------
$wp_customize->add_control(
	new OneStore_Customize_Control_HR(
		$wp_customize,
		'hr_button_typography',
		array(
			'section'     => $section,
			'settings'    => array(),
			'priority'    => 10,
		)
	)
);

// Button typography
$settings = array(
	'font_family'    => 'button_font_family',
	'font_weight'    => 'button_font_weight',
	'font_style'     => 'button_font_style',
	'text_transform' => 'button_text_transform',
	'font_size'      => 'button_font_size',
	'letter_spacing' => 'button_letter_spacing',
);
foreach ( $settings as $key ) {
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'typography' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Typography(
		$wp_customize,
		'button_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Button typography', 'onestore' ),
			'priority'    => 10,
		)
	)
);

// ------
$wp_customize->add_control(
	new OneStore_Customize_Control_HR(
		$wp_customize,
		'hr_button_colors',
		array(
			'section'     => $section,
			'settings'    => array(),
			'priority'    => 10,
		)
	)
);

// Colors
$colors = array(
	'button_bg_color'           => esc_html__( 'Background color', 'onestore' ),
	'button_border_color'       => esc_html__( 'Border color', 'onestore' ),
	'button_text_color'         => esc_html__( 'Text color', 'onestore' ),
	'button_hover_bg_color'     => esc_html__( 'Background color :hover', 'onestore' ),
	'button_hover_border_color' => esc_html__( 'Border color :hover', 'onestore' ),
	'button_hover_text_color'   => esc_html__( 'Text color :hover', 'onestore' ),
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
				'priority'    => 10,
			)
		)
	);
}
