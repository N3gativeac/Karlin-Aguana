<?php
/**
 * Customizer settings: Content & Sidebar > Sidebar Area
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_sidebar';

/**
 * ====================================================
 * Layout
 * ====================================================
 */

// Heading: Layout
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_sidebar_layout',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Layout', 'onestore' ),
			'priority'    => 10,
		)
	)
);

// Sidebar width.
$key = 'sidebar_width';
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
				'%' => array(
					'min'  => 15,
					'max'  => 40,
					'step' => 1,
				),
				'px' => array(
					'min'  => 150,
					'max'  => 400,
					'step' => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

// Sidebar gap.
$key = 'sidebar_gap';
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
			'label'       => esc_html__( 'Gap with main content', 'onestore' ),
			'units'       => array(
				'%' => array(
					'min'  => 0,
					'max'  => 10,
					'step' => 1,
				),
				'px' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

/**
 * ====================================================
 * Widgets
 * ====================================================
 */

// Heading: Widgets
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_sidebar_widgets',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Widgets', 'onestore' ),
			'priority'    => 30,
		)
	)
);

// Widgets mode
$key = 'sidebar_widgets_mode';
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
		'label'       => esc_html__( 'Widgets style', 'onestore' ),
		'choices'     => array(
			'merged'    => esc_html__( 'Merged in one box', 'onestore' ),
			'separated' => esc_html__( 'Separate boxes', 'onestore' ),
		),
		'priority'    => 30,
	)
);

// Gap between widgets
$key = 'sidebar_widgets_gap';
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
			'label'       => esc_html__( 'Gap between widgets', 'onestore' ),
			'units'       => array(
				'em' => array(
					'min'  => 0,
					'max'  => 10,
					'step' => 0.25,
				),
				'px' => array(
					'min'  => 0,
					'max'  => 80,
					'step' => 1,
				),
			),
			'priority'    => 30,
		)
	)
);

// Padding
$key = 'sidebar_padding';
$settings = array(
	$key,
	$key . '__tablet',
	$key . '__mobile',
);
foreach ( $settings as $setting ) {
	$wp_customize->add_setting(
		$setting,
		array(
			'default'     => onestore_array_value( $defaults, $setting ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimensions' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Dimensions(
		$wp_customize,
		$key,
		array(
			'settings'    => $settings,
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
			'priority'    => 30,
		)
	)
);

// Border
$key = 'sidebar_border';
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
			'label'       => esc_html__( 'Border', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'step' => 1,
				),
			),
			'priority'    => 30,
		)
	)
);

/**
 * ====================================================
 * Typography
 * ====================================================
 */

// Heading: Typography
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_sidebar_typography',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Typography', 'onestore' ),
			'priority'    => 40,
		)
	)
);

// Text typography
$settings = array(
	'font_family'    => 'sidebar_font_family',
	'font_weight'    => 'sidebar_font_weight',
	'font_style'     => 'sidebar_font_style',
	'text_transform' => 'sidebar_text_transform',
	'font_size'      => 'sidebar_font_size',
	'line_height'    => 'sidebar_line_height',
	'letter_spacing' => 'sidebar_letter_spacing',
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
		'sidebar_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Text typography', 'onestore' ),
			'priority'    => 40,
		)
	)
);

// Text typography
$settings = array(
	'font_family'    => 'sidebar_font_family',
	'font_weight'    => 'sidebar_font_weight',
	'font_style'     => 'sidebar_font_style',
	'text_transform' => 'sidebar_text_transform',
	'font_size'      => 'sidebar_font_size',
	'line_height'    => 'sidebar_line_height',
	'letter_spacing' => 'sidebar_letter_spacing',

	'font_size__tablet'      => 'sidebar_font_size__tablet',
	'line_height__tablet'    => 'sidebar_line_height__tablet',
	'letter_spacing__tablet' => 'sidebar_letter_spacing__tablet',

	'font_size__mobile'      => 'sidebar_font_size__mobile',
	'line_height__mobile'    => 'sidebar_line_height__mobile',
	'letter_spacing__mobile' => 'sidebar_letter_spacing__mobile',
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
		'sidebar_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Text typography', 'onestore' ),
			'priority'    => 40,
		)
	)
);

// Widget title typography
$settings = array(
	'font_family'    => 'sidebar_widget_title_font_family',
	'font_weight'    => 'sidebar_widget_title_font_weight',
	'font_style'     => 'sidebar_widget_title_font_style',
	'text_transform' => 'sidebar_widget_title_text_transform',
	'font_size'      => 'sidebar_widget_title_font_size',
	'line_height'    => 'sidebar_widget_title_line_height',
	'letter_spacing' => 'sidebar_widget_title_letter_spacing',

	'font_size_tablet'      => 'sidebar_widget_title_font_size__tablet',
	'line_height_tablet'    => 'sidebar_widget_title_line_height__tablet',
	'letter_spacing_tablet' => 'sidebar_widget_title_letter_spacing__tablet',

	'font_size_mobile'      => 'sidebar_widget_title_font_size__mobile',
	'line_height_mobile'    => 'sidebar_widget_title_line_height__mobile',
	'letter_spacing_mobile' => 'sidebar_widget_title_letter_spacing__mobile',
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
		'sidebar_widget_title_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Widget title typography', 'onestore' ),
			'priority'    => 40,
		)
	)
);

// Widget title alignment
$key = 'sidebar_widget_title_alignment';
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
		'label'       => esc_html__( 'Widget title alignment', 'onestore' ),
		'choices'     => array(
			'left'   => is_rtl() ? esc_html__( 'Right', 'onestore' ) : esc_html__( 'Left', 'onestore' ),
			'center' => esc_html__( 'Center', 'onestore' ),
			'right'  => is_rtl() ? esc_html__( 'Left', 'onestore' ) : esc_html__( 'Right', 'onestore' ),
		),
		'priority'    => 40,
	)
);

// Widget title decoration
$key = 'sidebar_widget_title_decoration';
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
		'label'       => esc_html__( 'Widget title decoration', 'onestore' ),
		'choices'     => array(
			'none'          => esc_html__( 'None', 'onestore' ),
			'box'           => esc_html__( 'Box', 'onestore' ),
			'border-bottom' => esc_html__( 'Border bottom', 'onestore' ),
		),
		'priority'    => 40,
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
		'heading_sidebar_colors',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Colors', 'onestore' ),
			'priority'    => 50,
		)
	)
);

// Colors
$colors = array(
	'sidebar_bg_color'                  => esc_html__( 'Background color', 'onestore' ),
	'sidebar_border_color'              => esc_html__( 'Border color', 'onestore' ),
	'sidebar_text_color'                => esc_html__( 'Text color', 'onestore' ),
	'sidebar_link_text_color'           => esc_html__( 'Link text color', 'onestore' ),
	'sidebar_link_hover_text_color'     => esc_html__( 'Link text color :hover', 'onestore' ),
	'sidebar_widget_title_text_color'   => esc_html__( 'Widget title text color', 'onestore' ),
	'sidebar_widget_title_bg_color'     => esc_html__( 'Widget title background color', 'onestore' ),
	'sidebar_widget_title_border_color' => esc_html__( 'Widget title border color', 'onestore' ),
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
				'priority'    => 50,
			)
		)
	);
}
