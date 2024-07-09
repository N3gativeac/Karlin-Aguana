<?php
/**
 * Customizer settings: Header > Logo
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$section = 'onestore_section_header_logo';

/**
 * ====================================================
 * Desktop Logo
 * ====================================================
 */

// Heading: Logo
$wp_customize->add_control( new OneStore_Customize_Control_Heading( $wp_customize, 'heading_header_logo', array(
	'section'     => $section,
	'settings'    => array(),
	'label'       => esc_html__( 'Logo', 'onestore' ),
	'priority'    => 10,
) ) );

// Logo
$key = 'custom_logo';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Logo image', 'onestore' ),
	'mime_type'   => 'image',
	'priority'    => 10,
) ) );

// Max width
$key = 'header_logo_width';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Dimension( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Max width', 'onestore' ),
	'units'       => array(
		'px' => array(
			'min'  => 0,
			'step' => 1,
		),
	),
	'priority'    => 10,
) ) );

/**
 * ====================================================
 * Mobile Logo
 * ====================================================
 */

// Heading: Mobile Logo
$wp_customize->add_control( new OneStore_Customize_Control_Heading( $wp_customize, 'heading_header_mobile_logo', array(
	'section'     => $section,
	'settings'    => array(),
	'label'       => esc_html__( 'Mobile Logo', 'onestore' ),
	'priority'    => 20,
) ) );

// Mobile Logo
$key = 'custom_logo_mobile';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Mobile Logo image', 'onestore' ),
	'mime_type'   => 'image',
	'priority'    => 20,
) ) );

// Max width
$key = 'header_mobile_logo_width';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Dimension( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Max width', 'onestore' ),
	'units'       => array(
		'px' => array(
			'min'  => 0,
			'step' => 1,
		),
	),
	'priority'    => 20,
) ) );