<?php
/**
 * Customizer settings: Footer > Scroll To Top
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$section = 'onestore_section_scroll_to_top';

/**
 * ====================================================
 * Visibility
 * ====================================================
 */

// Enable "Scroll to Top" button
$key = 'scroll_to_top';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'toggle' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Toggle( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Enable "Scroll to Top" button', 'onestore' ),
	'priority'    => 10,
) ) );

// ------
$wp_customize->add_control( new OneStore_Customize_Control_HR( $wp_customize, 'hr_scroll_to_top_display', array(
	'section'     => $section,
	'settings'    => array(),
	'priority'    => 10,
) ) );

// Visibility
$key = 'scroll_to_top_visibility';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'multiselect' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_MultiCheck( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Visibility', 'onestore' ),
	'choices'     => array(
		'desktop' => esc_html__( 'Desktop', 'onestore' ),
		'tablet'  => esc_html__( 'Tablet', 'onestore' ),
		'mobile'  => esc_html__( 'Mobile', 'onestore' ),
	),
	'priority'    => 10,
) ) );

// Display
$key = 'scroll_to_top_display';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'select' ),
) );
$wp_customize->add_control( $key, array(
	'type'        => 'select',
	'section'     => $section,
	'label'       => esc_html__( 'Display', 'onestore' ),
	'description' => esc_html__( 'Static: displayed at the very bottom of the page. Sticky: visible as user scrolls down through the page.', 'onestore' ),
	'choices'     => array(
		'static' => esc_html__( 'Static', 'onestore' ),
		'sticky' => esc_html__( 'Sticky', 'onestore' ),
	),
	'priority'    => 10,
) );

// Position
$key = 'scroll_to_top_position';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'select' ),
) );
$wp_customize->add_control( $key, array(
	'type'        => 'select',
	'section'     => $section,
	'label'       => esc_html__( 'Position', 'onestore' ),
	'choices'     => array(
		'left'  => is_rtl() ? esc_html__( 'Right', 'onestore' ) : esc_html__( 'Left', 'onestore' ),
		'right' => is_rtl() ? esc_html__( 'Left', 'onestore' ) : esc_html__( 'Right', 'onestore' ),
	),
	'priority'    => 10,
) );

// Horizontal offset
$key = 'scroll_to_top_h_offset';
$settings = array(
	$key,
	$key . '__tablet',
	$key . '__mobile',
);
foreach ( $settings as $setting ) {
	$wp_customize->add_setting( $setting, array(
		'default'     => onestore_array_value( $defaults, $setting ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
	) );
}
$wp_customize->add_control( new OneStore_Customize_Control_Slider( $wp_customize, $key, array(
	'settings'    => $settings,
	'section'     => $section,
	'label'       => esc_html__( 'Horizontal offset', 'onestore' ),
	'units'       => array(
		'px' => array(
			'min'  => 0,
			'max'  => 80,
			'step' => 1,
		),
	),
	'priority'    => 10,
) ) );

// Vertical offset
$key = 'scroll_to_top_v_offset';
$settings = array(
	$key,
	$key . '__tablet',
	$key . '__mobile',
);
foreach ( $settings as $setting ) {
	$wp_customize->add_setting( $setting, array(
		'default'     => onestore_array_value( $defaults, $setting ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
	) );
}
$wp_customize->add_control( new OneStore_Customize_Control_Slider( $wp_customize, $key, array(
	'settings'    => $settings,
	'section'     => $section,
	'label'       => esc_html__( 'Vertical offset', 'onestore' ),
	'units'       => array(
		'px' => array(
			'min'  => 0,
			'max'  => 80,
			'step' => 1,
		),
	),
	'priority'    => 10,
) ) );

// ------
$wp_customize->add_control( new OneStore_Customize_Control_HR( $wp_customize, 'hr_scroll_to_top_size', array(
	'section'     => $section,
	'settings'    => array(),
	'priority'    => 10,
) ) );

// Icon size
$key = 'scroll_to_top_icon_size';
$settings = array(
	$key,
	$key . '__tablet',
	$key . '__mobile',
);
foreach ( $settings as $setting ) {
	$wp_customize->add_setting( $setting, array(
		'default'     => onestore_array_value( $defaults, $setting ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
	) );
}
$wp_customize->add_control( new OneStore_Customize_Control_Slider( $wp_customize, $key, array(
	'settings'    => $settings,
	'section'     => $section,
	'label'       => esc_html__( 'Icon size', 'onestore' ),
	'units'       => array(
		'px' => array(
			'min'  => 0,
			'max'  => 60,
			'step' => 1,
		),
	),
	'priority'    => 10,
) ) );

// Padding
$key = 'scroll_to_top_padding';
$settings = array(
	$key,
	$key . '__tablet',
	$key . '__mobile',
);
foreach ( $settings as $setting ) {
	$wp_customize->add_setting( $setting, array(
		'default'     => onestore_array_value( $defaults, $setting ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
	) );
}
$wp_customize->add_control( new OneStore_Customize_Control_Slider( $wp_customize, $key, array(
	'settings'    => $settings,
	'section'     => $section,
	'label'       => esc_html__( 'Padding', 'onestore' ),
	'units'       => array(
		'px' => array(
			'min'  => 0,
			'max'  => 30,
			'step' => 1,
		),
	),
	'priority'    => 10,
) ) );

// Border radius
$key = 'scroll_to_top_border_radius';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Slider( $wp_customize, $key, array(
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
) ) );

// ------
$wp_customize->add_control( new OneStore_Customize_Control_HR( $wp_customize, 'hr_scroll_to_top_colors', array(
	'section'     => $section,
	'settings'    => array(),
	'priority'    => 10,
) ) );

// Colors
$colors = array(
	'scroll_to_top_bg_color'           => esc_html__( 'Background color', 'onestore' ),
	'scroll_to_top_text_color'         => esc_html__( 'Text color', 'onestore' ),
	'scroll_to_top_hover_bg_color'     => esc_html__( 'Background color :hover', 'onestore' ),
	'scroll_to_top_hover_text_color'   => esc_html__( 'Text color :hover', 'onestore' ),
);
foreach ( $colors as $key => $label ) {
	$wp_customize->add_setting( $key, array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'color' ),
	) );
	$wp_customize->add_control( new OneStore_Customize_Control_Color( $wp_customize, $key, array(
		'section'     => $section,
		'label'       => $label,
		'priority'    => 10,
	) ) );
}