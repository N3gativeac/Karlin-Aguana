<?php
// phpcs:ignore WPThemeReview.Templates.ReservedFileNamePrefix.ReservedTemplatePrefixFound

/**
 * Customizer settings: Page Canvas & Wrapper
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_page_container';

/**
 * ====================================================
 * Page Layout
 * ====================================================
 */

// Page layout.
$key = 'page_layout';
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
			'label'       => esc_html__( 'Page layout', 'onestore' ),
			'choices'     => array(
				'full-width' => array(
					'label' => esc_html__( 'Full width', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/page-layout--full-width.svg',
				),
				'boxed'      => array(
					'label' => esc_html__( 'Boxed', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/page-layout--boxed.svg',
				),
			),
			'priority'    => 10,
		)
	)
);

// ------
$wp_customize->add_control(
	new OneStore_Customize_Control_HR(
		$wp_customize,
		'hr_page_container_colors',
		array(
			'section'     => $section,
			'settings'    => array(),
			'priority'    => 10,
		)
	)
);

// Page background color.
$key = 'page_bg_color';
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
			'label'       => esc_html__( 'Page background color', 'onestore' ),
			'priority'    => 10,
		)
	)
);

/**
 * ====================================================
 * Layout Wrapper
 * ====================================================
 */

// Heading: Content Wrapper.
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_section_container',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Layout Wrapper', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Content wrapper width.
$key = 'container_width';
$settings = array(
	$key,
	$key . '__tablet',
	$key . '__mobile',
);
foreach ( $settings as $key ) {
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Slider(
		$wp_customize,
		'container_width',
		array(
			'section'     => $section,
			'settings'     => $settings,
			'label'       => esc_html__( 'Container Width', 'onestore' ),
			'units'       => array(
				'%' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'px' => array(
					'min'  => 0,
					'max'  => 2500,
					'step' => 1,
				),
				'em' => array(
					'min'  => 0,
					'max'  => 500,
					'step' => .5,
				),
			),
			'priority'    => 20,
		)
	)
);



// Content wrapper margin.
$key = 'container_padding';
$settings = array(
	$key,
	$key . '__tablet',
	$key . '__mobile',
);
foreach ( $settings as $key ) {
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'transport'   => 'postMessage',
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Slider(
		$wp_customize,
		'container_padding',
		array(
			'section'     => $section,
			'settings'     => $settings,
			'label'       => esc_html__( 'Container Padding', 'onestore' ),
			'units'       => array(
				'%' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'px' => array(
					'min'  => 0,
					'max'  => 300,
					'step' => 1,
				),
				'em' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => .5,
				),
			),
			'priority'    => 21,
		)
	)
);







/**
 * ====================================================
 * Boxed Page
 * ====================================================
 */

// Heading: Boxed Page
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_boxed_page',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Boxed Page', 'onestore' ),
			'priority'    => 30,
		)
	)
);

// Boxed page width.
$key = 'boxed_page_width';
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
			'label'       => esc_html__( 'Boxed page max width', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 500,
					'max'  => 2000,
					'step' => 1,
				),
				'%' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'em' => array(
					'min'  => 0,
					'max'  => 600,
					'step' => 1,
				),
			),
			'priority'    => 30,
		)
	)
);

// Boxed page shadow.
$key = 'boxed_page_shadow';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'shadow' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Shadow(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Boxed page shadow', 'onestore' ),
			'priority'    => 30,
		)
	)
);

// ------
$wp_customize->add_control(
	new OneStore_Customize_Control_HR(
		$wp_customize,
		'hr_boxed_page_outside',
		array(
			'section'     => $section,
			'settings'    => array(),
			'priority'    => 30,
		)
	)
);

// Outside background color
$key = 'outside_bg_color';
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
			'label'       => esc_html__( 'Outside background color', 'onestore' ),
			'priority'    => 30,
		)
	)
);

// Outside background image
$key = 'outside_bg_image';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'transport'   => 'postMessage',
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'image' ),
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Outside background image', 'onestore' ),
			'mime_type'   => 'image',
			'priority'    => 30,
		)
	)
);

// Outside background position
$key = 'outside_bg_position';
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
		'label'       => esc_html__( 'Outside background position', 'onestore' ),
		'choices'     => array(
			'left top'      => esc_html__( 'Left top', 'onestore' ),
			'left center'   => esc_html__( 'Left center', 'onestore' ),
			'left bottom'   => esc_html__( 'Left bottom', 'onestore' ),
			'center top'    => esc_html__( 'Center top', 'onestore' ),
			'center center' => esc_html__( 'Center center', 'onestore' ),
			'center bottom' => esc_html__( 'Center bottom', 'onestore' ),
			'right top'     => esc_html__( 'Right top', 'onestore' ),
			'right center'  => esc_html__( 'Right center', 'onestore' ),
			'right bottom'  => esc_html__( 'Right bottom', 'onestore' ),
		),
		'priority'    => 30,
	)
);

// Outside background size
$key = 'outside_bg_size';
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
		'label'       => esc_html__( 'Outside background size', 'onestore' ),
		'choices'     => array(
			'auto'    => esc_html__( 'Default', 'onestore' ),
			'cover'   => esc_html__( 'Cover', 'onestore' ),
			'contain' => esc_html__( 'Contain', 'onestore' ),
		),
		'priority'    => 30,
	)
);

// Outside background repeat
$key = 'outside_bg_repeat';
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
		'label'       => esc_html__( 'Outside background repeat', 'onestore' ),
		'choices'     => array(
			'no-repeat' => esc_html__( 'No repeat', 'onestore' ),
			'repeat-x'  => esc_html__( 'Repeat X (horizontally)', 'onestore' ),
			'repeat-y'  => esc_html__( 'Repeat Y (vertically)', 'onestore' ),
			'repeat'    => esc_html__( 'Repeat both axis', 'onestore' ),
		),
		'priority'    => 30,
	)
);

// Outside background attachment
$key = 'outside_bg_attachment';
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
		'label'       => esc_html__( 'Outside background attachment', 'onestore' ),
		'choices'     => array(
			'scroll' => esc_html__( 'Scroll', 'onestore' ),
			'fixed'  => esc_html__( 'Fixed', 'onestore' ),
		),
		'priority'    => 30,
	)
);
