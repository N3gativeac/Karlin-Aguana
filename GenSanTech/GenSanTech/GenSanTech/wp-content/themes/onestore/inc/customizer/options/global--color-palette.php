<?php
/**
 * Customizer settings: Global Settings > Color Palette
 *
 * @package OneStore Pro
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$section = 'onestore_section_color_palette';

/**
 * ====================================================
 * Color Palette
 * ====================================================
 */

// Colors
for ( $i = 1; $i <= 8; $i++ ) {
	$key = 'color_palette_' . $i;

	$wp_customize->add_setting( $key, array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'color' ),
	) );
	$wp_customize->add_control( new OneStore_Customize_Control_Color( $wp_customize, $key, array(
		'section'     => $section,
		/* translators: %s: color number. */
		'label'       => sprintf( esc_html__( 'Color %s', 'onestore' ), $i ),
		'has_palette' => false,
		'priority'    => 10,
	) ) );
}

// Info
$wp_customize->add_control( new OneStore_Customize_Control_Blank( $wp_customize, 'notice_color_palette', array(
	'section'     => $section,
	'settings'    => array(),
	'description' => '<div class="notice notice-info notice-alt inline"><p>' . esc_html__( 'After changing colors, publish the changes and then reload this Customizer page to apply them on all color controls.', 'onestore' ) . '</p></div>',
	'priority'    => 10,
) ) );

/**
 * ====================================================
 * Gutenberg Integration
 * ====================================================
 */

// Heading: Gutenberg Integration
$wp_customize->add_control( new OneStore_Customize_Control_Heading( $wp_customize, 'heading_color_palette_gutenberg', array(
	'section'     => $section,
	'settings'    => array(),
	'label'       => esc_html__( 'Gutenberg Integration', 'onestore' ),
	'priority'    => 20,
) ) );

// Use as Gutenberg color palette
$key = 'color_palette_in_gutenberg';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'toggle' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Toggle( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Use as Gutenberg color palette', 'onestore' ),
	'description' => esc_html__( 'Enabling this would replace the original Gutenberg\'s color palette with the colors you defined above.', 'onestore' ),
	'priority'    => 20,
) ) );