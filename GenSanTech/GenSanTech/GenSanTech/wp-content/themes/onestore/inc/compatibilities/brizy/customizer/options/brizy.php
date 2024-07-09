<?php
/**
 * Customizer settings: Brizy Integration
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$section = 'onestore_section_brizy';

/**
 * ====================================================
 * Brizy Integration
 * ====================================================
 */

// Use container width
$key = 'brizy_use_container_width';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'toggle' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Toggle( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Use theme\'s content width as Brizy content width', 'onestore' ),
	'description' => esc_html__( 'By default, Brizy doesn\'t have the option to change the maximum content width (fixed at 1170px). Enabling this option will make Brizy use theme\'s content wrapper width as Brizy content width, so you\'ll have consistent content width between header, footer, and your Brizy content.', 'onestore' ),
	'priority'    => 10,
) ) );

// Disable Brizy's reset CSS
$key = 'brizy_disable_reset_css';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'toggle' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Toggle( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Disable Brizy\'s reset CSS', 'onestore' ),
	'description' => esc_html__( 'By default, Brizy applies reset CSS to the content and causes any non-native Brizy element (e.g. shortcode) to be unstyled. Disabling Brizy reset CSS makes those elements\' inherit theme CSS.', 'onestore' ),
	'priority'    => 10,
) ) );