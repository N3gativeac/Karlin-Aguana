<?php
/**
 * Customizer settings: Blog > Single Post
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$section = 'onestore_section_blog_single';

/**
 * ====================================================
 * Additional Elements
 * ====================================================
 */

// Author bio
$key = 'blog_single_author_bio';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'toggle' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Toggle( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Show author bio', 'onestore' ),
	'priority'    => 10,
) ) );

// Prev / next posts navigation
$key = 'blog_single_navigation';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'toggle' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Toggle( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Show prev / next posts navigation', 'onestore' ),
	'priority'    => 10,
) ) );