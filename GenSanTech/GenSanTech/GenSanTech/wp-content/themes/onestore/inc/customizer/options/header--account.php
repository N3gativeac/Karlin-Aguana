<?php
/**
 * Customizer settings: Header > Cart
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_header_account';

/**
 * ====================================================
 * Colors
 * ====================================================
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	// Notice.
	$wp_customize->add_control(
		new OneStore_Customize_Control_Blank(
			$wp_customize,
			'notice_header_account',
			array(
				'section'     => $section,
				'settings'    => array(),
				'description' => '<div class="notice notice-warning notice-alt inline"><p>' . esc_html__( 'Only available if WooCommerce plugin is installed and activated.', 'onestore' ) . '</p></div>',
				'priority'    => 10,
			)
		)
	);
}

// Avatar width.
$key = 'header_account_avatar_size';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Slider(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Avatar Size', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'   => 0,
					'step'  => 1,
					'max'   => 100,
				),
			),
			'priority'    => 10,
		)
	)
);
