<?php
/**
 * Customizer settings: Header > Mobile Drawer (Popup)
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_header_mobile_vertical_bar';

/**
 * ====================================================
 * Layout
 * ====================================================
 */

// Display
$key = 'header_mobile_vertical_bar_display';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'select' ),
	)
);
$wp_customize->add_control(
	$key,
	array(
		'type'        => 'select',
		'section'     => $section,
		'label'       => esc_html__( 'Display', 'onestore' ),
		'choices'     => array(
			'drawer'      => esc_html__( 'Drawer (slide in popup)', 'onestore' ),
			'full-screen' => esc_html__( 'Full screen', 'onestore' ),
		),
		'priority'    => 10,
	)
);

// Position
$key = 'header_mobile_vertical_bar_position';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'select' ),
	)
);
$wp_customize->add_control(
	$key,
	array(
		'type'        => 'select',
		'section'     => $section,
		'label'       => esc_html__( 'Position', 'onestore' ),
		'choices'     => array(
			'left'   => is_rtl() ? esc_html__( 'Right', 'onestore' ) : esc_html__( 'Left', 'onestore' ),
			'right'  => is_rtl() ? esc_html__( 'Left', 'onestore' ) : esc_html__( 'Right', 'onestore' ),
			'center' => esc_html__( 'Center (only for Full Screen)', 'onestore' ),
		),
		'priority'    => 10,
	)
);

// Alignment
$key = 'header_mobile_vertical_bar_alignment';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'select' ),
	)
);
$wp_customize->add_control(
	$key,
	array(
		'type'        => 'select',
		'section'     => $section,
		'label'       => esc_html__( 'Alignment', 'onestore' ),
		'choices'     => array(
			'left'   => is_rtl() ? esc_html__( 'Right', 'onestore' ) : esc_html__( 'Left', 'onestore' ),
			'center' => esc_html__( 'Center', 'onestore' ),
			'right'  => is_rtl() ? esc_html__( 'Left', 'onestore' ) : esc_html__( 'Right', 'onestore' ),
		),
		'priority'    => 10,
	)
);

// Width
$key = 'header_mobile_vertical_bar_width';
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
			'label'       => esc_html__( 'Width', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'   => 120,
					'max'   => 400,
					'step'  => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

// Padding
$key = 'header_mobile_vertical_bar_padding';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimensions' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Dimensions(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Padding', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'step' => 1,
				),
				'em' => array(
					'min'  => 0,
					'step' => 0.05,
				),
				'%' => array(
					'min'  => 0,
					'step' => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

// Items gutter
$key = 'header_mobile_vertical_bar_items_gutter';
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
			'label'       => esc_html__( 'Spacing between elements', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'   => 0,
					'max'   => 40,
					'step'  => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

/**
 * ====================================================
 * Typography
 * ====================================================
 */

// Heading: Typography.
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_header_mobile_vertical_bar_typography',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Typography', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Text typography.
$settings = array(
	'font_family'    => 'header_mobile_vertical_bar_font_family',
	'font_weight'    => 'header_mobile_vertical_bar_font_weight',
	'font_style'     => 'header_mobile_vertical_bar_font_style',
	'text_transform' => 'header_mobile_vertical_bar_text_transform',
	'font_size'      => 'header_mobile_vertical_bar_font_size',
	'line_height'    => 'header_mobile_vertical_bar_line_height',
	'letter_spacing' => 'header_mobile_vertical_bar_letter_spacing',
);
foreach ( $settings as $key ) {
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'typography' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Typography(
		$wp_customize,
		'header_mobile_vertical_bar_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Text typography', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Menu link typography
$settings = array(
	'font_family'    => 'header_mobile_vertical_bar_menu_font_family',
	'font_weight'    => 'header_mobile_vertical_bar_menu_font_weight',
	'font_style'     => 'header_mobile_vertical_bar_menu_font_style',
	'text_transform' => 'header_mobile_vertical_bar_menu_text_transform',
	'font_size'      => 'header_mobile_vertical_bar_menu_font_size',
	'line_height'    => 'header_mobile_vertical_bar_menu_line_height',
	'letter_spacing' => 'header_mobile_vertical_bar_menu_letter_spacing',
);
foreach ( $settings as $key ) {
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'typography' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Typography(
		$wp_customize,
		'header_mobile_vertical_bar_menu_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Menu link typography', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Submenu link typography
$settings = array(
	'font_family'    => 'header_mobile_vertical_bar_submenu_font_family',
	'font_weight'    => 'header_mobile_vertical_bar_submenu_font_weight',
	'font_style'     => 'header_mobile_vertical_bar_submenu_font_style',
	'text_transform' => 'header_mobile_vertical_bar_submenu_text_transform',
	'font_size'      => 'header_mobile_vertical_bar_submenu_font_size',
	'line_height'    => 'header_mobile_vertical_bar_submenu_line_height',
	'letter_spacing' => 'header_mobile_vertical_bar_submenu_letter_spacing',
);
foreach ( $settings as $key ) {
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'typography' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Typography(
		$wp_customize,
		'header_mobile_vertical_bar_submenu_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Submenu link typography', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Icon size
$key = 'header_mobile_vertical_bar_icon_size';
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
			'label'       => esc_html__( 'Icon size', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'max'  => 60,
					'step' => 1,
				),
			),
			'priority'    => 20,
		)
	)
);

/**
 * ====================================================
 * Colors
 * ====================================================
 */

// Heading: Colors
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_header_mobile_vertical_bar_colors',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Colors', 'onestore' ),
			'priority'    => 30,
		)
	)
);

// Colors
$colors = array(
	'header_mobile_vertical_bar_bg_color'               => esc_html__( 'Background color', 'onestore' ),
	'header_mobile_vertical_bar_border_color'           => esc_html__( 'Border color', 'onestore' ),
	'header_mobile_vertical_bar_text_color'             => esc_html__( 'Text color', 'onestore' ),
	'header_mobile_vertical_bar_link_text_color'        => esc_html__( 'Link text color', 'onestore' ),
	'header_mobile_vertical_bar_link_hover_text_color'  => esc_html__( 'Link text color :hover', 'onestore' ),
	'header_mobile_vertical_bar_link_active_text_color' => esc_html__( 'Link text color :active', 'onestore' ),
);
foreach ( $colors as $key => $label ) {
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'color' ),
		)
	);
	$wp_customize->add_control(
		new OneStore_Customize_Control_Color(
			$wp_customize,
			$key,
			array(
				'section'     => $section,
				'label'       => $label,
				'priority'    => 30,
			)
		)
	);
}
