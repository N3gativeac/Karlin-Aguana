<?php
/**
 * Customizer settings: General Styles > Border & Subtitle Background
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$section = 'onestore_section_line_subtitle';

// Line / border color
$key = 'border_color';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'color' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Color( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Line / border color', 'onestore' ),
	'description' => esc_html__( 'Used on &lt;hr&gt; and default border color of all elements.', 'onestore' ),
	'priority'    => 10,
) ) );

// Subtitle color
$key = 'subtitle_color';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'color' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Color( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Subtitle background color', 'onestore' ),
	'description' => esc_html__( 'Used as background color of &lt;code&gt;, &lt;pre&gt;, tagclouds, and archive title. Usually slightly darker or lighter than the page background color.', 'onestore' ),
	'priority'    => 10,
) ) );
