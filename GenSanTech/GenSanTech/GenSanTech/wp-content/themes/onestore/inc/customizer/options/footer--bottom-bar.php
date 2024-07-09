<?php
/**
 * Customizer settings: Footer > Bottom Bar
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

$section = 'onestore_section_footer_bottom_bar';

/**
 * ====================================================
 * Layout
 * ====================================================
 */

// Merge inside Main Bar
$key = 'footer_bottom_bar_merged';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'toggle' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Toggle( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Merge inside Widgets Bar wrapper', 'onestore' ),
	'priority'    => 10,
) ) );

// Merged gap
$key = 'footer_bottom_bar_merged_gap';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Dimension( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Gap with Widgets Bar content', 'onestore' ),
	'units'       => array(
		'px' => array(
			'min'   => 0,
			'step'  => 1,
		),
	),
	'priority'    => 10,
) ) );

// ------
$wp_customize->add_control( new OneStore_Customize_Control_HR( $wp_customize, 'hr_footer_bottom_bar_merged', array(
	'section'     => $section,
	'settings'    => array(),
	'priority'    => 10,
) ) );

// Layout
$key = 'footer_bottom_bar_container';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'select' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_RadioImage( $wp_customize, $key, array(
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
) ) );

// Padding
$key = 'footer_bottom_bar_padding';
$settings = array(
	$key,
	$key . '__tablet',
	$key . '__mobile',
);
foreach ( $settings as $setting ) {
	$wp_customize->add_setting( $setting, array(
		'default'     => onestore_array_value( $defaults, $setting ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimensions' ),
	) );
}
$wp_customize->add_control( new OneStore_Customize_Control_Dimensions( $wp_customize, $key, array(
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
) ) );

// Border
$key = 'footer_bottom_bar_border';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimensions' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Dimensions( $wp_customize, $key, array(
	'section'     => $section,
	'label'       => esc_html__( 'Border', 'onestore' ),
	'units'       => array(
		'px' => array(
			'min'  => 0,
			'step' => 1,
		),
	),
	'priority'    => 10,
) ) );

// Items gutter
$key = 'footer_bottom_bar_items_gutter';
$wp_customize->add_setting( $key, array(
	'default'     => onestore_array_value( $defaults, $key ),
	'transport'   => 'postMessage',
	'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
) );
$wp_customize->add_control( new OneStore_Customize_Control_Slider( $wp_customize, $key, array(
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
) ) );

/**
 * ====================================================
 * Typography
 * ====================================================
 */

// Heading: Typography
$wp_customize->add_control( new OneStore_Customize_Control_Heading( $wp_customize, 'heading_footer_bottom_bar_typography', array(
	'section'     => $section,
	'settings'    => array(),
	'label'       => esc_html__( 'Typography', 'onestore' ),
	'priority'    => 20,
) ) );

// Text typography
$settings = array(
	'font_family'    => 'footer_bottom_bar_font_family',
	'font_weight'    => 'footer_bottom_bar_font_weight',
	'font_style'     => 'footer_bottom_bar_font_style',
	'text_transform' => 'footer_bottom_bar_text_transform',
	'font_size'      => 'footer_bottom_bar_font_size',
	'line_height'    => 'footer_bottom_bar_line_height',
	'letter_spacing' => 'footer_bottom_bar_letter_spacing',

	'font_size__tablet'      => 'footer_bottom_bar_font_size__tablet',
	'line_height__tablet'    => 'footer_bottom_bar_line_height__tablet',
	'letter_spacing__tablet' => 'footer_bottom_bar_letter_spacing__tablet',

	'font_size__mobile'      => 'footer_bottom_bar_font_size__mobile',
	'line_height__mobile'    => 'footer_bottom_bar_line_height__mobile',
	'letter_spacing__mobile' => 'footer_bottom_bar_letter_spacing__mobile',
);
foreach ( $settings as $key ) {
	$wp_customize->add_setting( $key, array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'typography' ),
	) );
}
$wp_customize->add_control( new OneStore_Customize_Control_Typography( $wp_customize, 'footer_bottom_bar_typography', array(
	'settings'    => $settings,
	'section'     => $section,
	'label'       => esc_html__( 'Text typography', 'onestore' ),
	'priority'    => 20,
) ) );

/**
 * ====================================================
 * Colors
 * ====================================================
 */

// Heading: Colors
$wp_customize->add_control( new OneStore_Customize_Control_Heading( $wp_customize, 'heading_footer_bottom_bar_colors', array(
	'section'     => $section,
	'settings'    => array(),
	'label'       => esc_html__( 'Colors', 'onestore' ),
	'priority'    => 30,
) ) );

// Colors
$colors = array(
	'footer_bottom_bar_bg_color'              => esc_html__( 'Background color', 'onestore' ),
	'footer_bottom_bar_border_color'          => esc_html__( 'Border color', 'onestore' ),
	'footer_bottom_bar_text_color'            => esc_html__( 'Text color', 'onestore' ),
	'footer_bottom_bar_link_text_color'       => esc_html__( 'Link text color', 'onestore' ),
	'footer_bottom_bar_link_hover_text_color' => esc_html__( 'Link text color :hover', 'onestore' ),
);
foreach ( $colors as $key => $label ) {
	$wp_customize->add_setting( $key, array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'color' ),
	) );
	$wp_customize->add_control( new OneStore_Customize_Control_Color( $wp_customize, $key, array(
		'section'     => $section,
		'label'       => $label,
		'priority'    => 30,
	) ) );
}