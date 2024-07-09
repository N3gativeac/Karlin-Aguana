<?php
/**
 * Customizer settings: Footer > Widgets Bar
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_footer_widgets_bar';

/**
 * ====================================================
 * Layout
 * ====================================================
 */

// Layout
$key = 'footer_widgets_bar_container';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'select' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_RadioImage(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Layout', 'onestore' ),
			'choices'     => array(
				'default'    => array(
					'label' => esc_html__( 'Normal', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/footer-container--default.svg',
				),
				'full-width' => array(
					'label' => esc_html__( 'Full width', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/footer-container--full-width.svg',
				),
				'contained'  => array(
					'label' => esc_html__( 'Contained', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/footer-container--contained.svg',
				),
			),
			'priority'    => 10,
		)
	)
);

// Padding
$key = 'footer_widgets_bar_padding';
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
			'priority'    => 10,
		)
	)
);

// Border
$key = 'footer_widgets_bar_border';
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
			'priority'    => 10,
		)
	)
);

// Columns gutter
$key = 'footer_widgets_bar_columns_gutter';
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
			'label'       => esc_html__( 'Columns gutter', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'max'  => 40,
					'step' => 1,
				),
			),
			'priority'    => 10,
		)
	)
);

// Gap between widgets
$key = 'footer_widgets_bar_widgets_gap';
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
				'px' => array(
					'min'  => 0,
					'max'  => 80,
					'step' => 1,
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

// Heading: Typography
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_footer_widgets_bar_typography',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Typography', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Text typography
$settings = array(
	'font_family'    => 'footer_widgets_bar_font_family',
	'font_weight'    => 'footer_widgets_bar_font_weight',
	'font_style'     => 'footer_widgets_bar_font_style',
	'text_transform' => 'footer_widgets_bar_text_transform',
	'font_size'      => 'footer_widgets_bar_font_size',
	'line_height'    => 'footer_widgets_bar_line_height',
	'letter_spacing' => 'footer_widgets_bar_letter_spacing',
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
		'footer_widgets_bar_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Text typography', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Widget title typography
$settings = array(
	'font_family'    => 'footer_widgets_bar_widget_title_font_family',
	'font_weight'    => 'footer_widgets_bar_widget_title_font_weight',
	'font_style'     => 'footer_widgets_bar_widget_title_font_style',
	'text_transform' => 'footer_widgets_bar_widget_title_text_transform',
	'font_size'      => 'footer_widgets_bar_widget_title_font_size',
	'line_height'    => 'footer_widgets_bar_widget_title_line_height',
	'letter_spacing' => 'footer_widgets_bar_widget_title_letter_spacing',

	'font_size_tablet'      => 'footer_widgets_bar_widget_title_font_size__tablet',
	'line_height_tablet'    => 'footer_widgets_bar_widget_title_line_height__tablet',
	'letter_spacing_tablet' => 'footer_widgets_bar_widget_title_letter_spacing__tablet',

	'font_size_mobile'      => 'footer_widgets_bar_widget_title_font_size__mobile',
	'line_height_mobile'    => 'footer_widgets_bar_widget_title_line_height__mobile',
	'letter_spacing_mobile' => 'footer_widgets_bar_widget_title_letter_spacing__mobile',
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
		'footer_widgets_bar_widget_title_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Widget title typography', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Widget title alignment
$key = 'footer_widgets_bar_widget_title_alignment';
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
		'priority'    => 20,
	)
);

// Widget title decoration
$key = 'footer_widgets_bar_widget_title_decoration';
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
		'priority'    => 20,
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
		'heading_footer_widgets_bar_colors',
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
	'footer_widgets_bar_bg_color'                  => esc_html__( 'Background color', 'onestore' ),
	'footer_widgets_bar_border_color'              => esc_html__( 'Border color', 'onestore' ),
	'footer_widgets_bar_text_color'                => esc_html__( 'Text color', 'onestore' ),
	'footer_widgets_bar_link_text_color'           => esc_html__( 'Link text color', 'onestore' ),
	'footer_widgets_bar_link_hover_text_color'     => esc_html__( 'Link text color :hover', 'onestore' ),
	'footer_widgets_bar_widget_title_text_color'   => esc_html__( 'Widget title text color', 'onestore' ),
	'footer_widgets_bar_widget_title_bg_color'     => esc_html__( 'Widget title background color', 'onestore' ),
	'footer_widgets_bar_widget_title_border_color' => esc_html__( 'Widget title border color', 'onestore' ),
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
