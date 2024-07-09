<?php
/**
 * Customizer settings: Content & Sidebar > Main Content Area
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_main';

/**
 * ====================================================
 * Main Content Area
 * ====================================================
 */

// Padding
$key = 'content_main_padding';
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

// Border
$key = 'content_main_border';
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

/**
 * ====================================================
 * Typography
 * ====================================================
 */

// Heading: Typography
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_content_main_typography',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Typography', 'onestore' ),
			'description' => sprintf(
				/* translators: %s: link to "Body (Base)" section. */
				esc_html__( 'Inherit typography settings from %s.', 'onestore' ),
				'<a href="' . esc_attr( add_query_arg( 'autofocus[section]', 'onestore_section_body', remove_query_arg( 'autofocus' ) ) ) . '" class="onestore-customize-goto-control">' . esc_html__( 'Body (Base)', 'onestore' ) . '</a>'
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
		'heading_content_main_colors',
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
	'content_main_bg_color'     => esc_html__( 'Content Box BG color', 'onestore' ),
	'content_main_border_color' => esc_html__( 'Content Box border color', 'onestore' ),
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
