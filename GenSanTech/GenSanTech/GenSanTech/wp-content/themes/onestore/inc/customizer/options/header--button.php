<?php
/**
 * Customizer settings: Header > HTML
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_header_button';

/**
 * ====================================================
 * HTML Element
 * ====================================================
 */

$start = 10;
for ( $i = 1; $i < 6; $i ++ ) {
	// Heading: button
	$start = $start + 10;
	$wp_customize->add_control(
		new OneStore_Customize_Control_Heading(
			$wp_customize,
			'heading_header_button_' . $i,
			array(
				'section'     => $section,
				'settings'    => array(),
				/* translators: %s: number of HTML element. */
				'label'       => sprintf( esc_html__( 'Button %s', 'onestore' ), $i ),
				'priority'    => $start,
			)
		)
	);

	// Content.
	$key = 'header_button_' . $i . '_text';
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => false,
		)
	);
	$wp_customize->add_control(
		$key,
		array(
			'type'        => 'text',
			'section'     => $section,
			'label'       => sprintf( esc_html__( 'Button %s Text', 'onestore' ), $i ),
			'priority'    => $start,
		)
	);

	// Content.
	$key = 'header_button_' . $i . '_url';
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => false,
		)
	);
	$wp_customize->add_control(
		$key,
		array(
			'type'        => 'text',
			'section'     => $section,
			'label'       => sprintf( esc_html__( 'Button %s URL', 'onestore' ), $i ),
			'priority'    => $start,
		)
	);


	// icon.
	$key = 'header_button_' . $i . '_icon';
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => false,
		)
	);
	$wp_customize->add_control(
		$key,
		array(
			'type'        => 'text',
			'section'     => $section,
			'label'       => sprintf( esc_html__( 'Button %s Icon', 'onestore' ), $i ),
			'priority'    => $start,
		)
	);

	// class.
	$key = 'header_button_' . $i . '_class';
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'text' ),
		)
	);
	$wp_customize->add_control(
		$key,
		array(
			'type'        => 'text',
			'section'     => $section,
			'label'       => sprintf( esc_html__( 'Button %s Class', 'onestore' ), $i ),
			'priority'    => $start,
		)
	);

	// Selective Refresh.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			$key,
			array(
				'selector'            => '.header-button-' . $i,
				'container_inclusive' => true,
				'render_callback'     => 'onestore_header_element__button_' . $i,
				'fallback_refresh'    => false,
			)
		);
	}
}
