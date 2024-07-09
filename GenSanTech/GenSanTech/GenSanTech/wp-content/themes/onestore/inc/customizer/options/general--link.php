<?php
/**
 * Customizer settings: General Styles > Link
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$section = 'onestore_section_link';

// Colors
$colors = array(
	'link_text_color'       => esc_html__( 'Link text color', 'onestore' ),
	'link_hover_text_color' => esc_html__( 'Link text color :hover', 'onestore' ),
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
		'priority'    => 20,
	) ) );
}