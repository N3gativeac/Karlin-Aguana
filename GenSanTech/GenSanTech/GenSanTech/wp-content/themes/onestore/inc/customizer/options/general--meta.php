<?php
/**
 * Customizer settings: General Styles > Meta
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$section = 'onestore_section_meta';

// Typography
$settings = array(
	'font_family'    => 'meta_font_family',
	'font_weight'    => 'meta_font_weight',
	'font_style'     => 'meta_font_style',
	'text_transform' => 'meta_text_transform',
	'font_size'      => 'meta_font_size',
	'line_height'    => 'meta_line_height',
	'letter_spacing' => 'meta_letter_spacing',

	'font_size__tablet'      => 'meta_font_size__tablet',
	'line_height__tablet'    => 'meta_line_height__tablet',
	'letter_spacing__tablet' => 'meta_letter_spacing__tablet',

	'font_size__mobile'      => 'meta_font_size__mobile',
	'line_height__mobile'    => 'meta_line_height__mobile',
	'letter_spacing__mobile' => 'meta_letter_spacing__mobile',
);
foreach ( $settings as $key ) {
	$wp_customize->add_setting( $key, array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'typography' ),
	) );
}
$wp_customize->add_control( new OneStore_Customize_Control_Typography( $wp_customize, 'meta_typography', array(
	'settings'    => $settings,
	'section'     => $section,
	'label'       => esc_html__( 'Meta typography', 'onestore' ),
	'priority'    => 10,
) ) );

// ------
$wp_customize->add_control( new OneStore_Customize_Control_HR( $wp_customize, 'hr_meta_colors', array(
	'section'     => $section,
	'settings'    => array(),
	'priority'    => 10,
) ) );

// Colors
$colors = array(
	'meta_text_color'            => esc_html__( 'Meta text color', 'onestore' ),
	'meta_link_text_color'       => esc_html__( 'Meta link text color', 'onestore' ),
	'meta_link_hover_text_color' => esc_html__( 'Meta link text color :hover', 'onestore' ),
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