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

$section = 'onestore_section_header_html';

/**
 * ====================================================
 * HTML Element
 * ====================================================
 */


for ( $i = 1; $i < 6; $i ++ ) {
	// Heading: HTML
	$wp_customize->add_control(
		new OneStore_Customize_Control_Heading(
			$wp_customize,
			'heading_header_html_' . $i,
			array(
				'section'     => $section,
				'settings'    => array(),
				/* translators: %s: number of HTML element. */
				'label'       => sprintf( esc_html__( 'HTML %s', 'onestore' ), $i ),
				'priority'    => 10,
			)
		)
	);

	// Content.
	$key = 'header_html_' . $i . '_content';
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
			'type'        => 'textarea',
			'section'     => $section,
			'description' => esc_html__( 'Plain text, HTML tags, and shortcode are allowed.', 'onestore' ),
			'priority'    => 10,
		)
	);

	// Selective Refresh.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			$key,
			array(
				'selector'            => '.header-html-' . $i,
				'container_inclusive' => true,
				'render_callback'     => 'onestore_header_element__html_' . $i,
				'fallback_refresh'    => false,
			)
		);
	}
}
