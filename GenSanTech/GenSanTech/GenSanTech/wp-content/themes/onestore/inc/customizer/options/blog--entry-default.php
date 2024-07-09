<?php
/**
 * Customizer settings: Blog > Post Layout: Default
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_entry_default';

// Items gap.
$key = 'blog_index_default_items_gap';
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
			'label'       => esc_html__( 'Items gap', 'onestore' ),
			'units'       => array(
				'px' => array(
					'min'  => 0,
					'max'  => 300,
					'step' => 1,
				),
				'em' => array(
					'min'  => 0,
					'max'  => 20,
					'step' => 0.05,
				),
			),
			'priority'    => 10,
		)
	)
);

/**
 * ====================================================
 * Featured Media
 * ====================================================
 */

// Heading: Featured Media
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_entry_featured_media',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Featured Media', 'onestore' ),
			'priority'    => 30,
		)
	)
);

// Featured media position
$key = 'entry_featured_media_position';
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
		'label'       => esc_html__( 'Featured media position', 'onestore' ),
		'choices'     => array(
			'before-entry-header' => esc_html__( 'Before Post Header', 'onestore' ),
			'after-entry-header'  => esc_html__( 'After Post Header', 'onestore' ),
			'disabled'            => esc_html__( 'Disabled', 'onestore' ),
		),
		'priority'    => 30,
	)
);

// Ignore padding
$key = 'entry_featured_media_ignore_padding';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'toggle' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Toggle(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Ignore padding', 'onestore' ),
			'priority'    => 30,
		)
	)
);

/**
 * ====================================================
 * Post Header
 * ====================================================
 */

// Heading: Post Header
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_entry_header',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Post Header', 'onestore' ),
			'priority'    => 40,
		)
	)
);

// Elements to display
$key = 'entry_header';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'multiselect' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Builder(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Elements to display', 'onestore' ),
			'choices'     => array(
				'header-meta' => esc_html__( 'Header Meta', 'onestore' ),
				'title'       => esc_html__( 'Title', 'onestore' ),
			),
			'layout'      => 'block',
			'priority'    => 40,
		)
	)
);

// Alignment
$key = 'entry_header_alignment';
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
		'priority'    => 40,
	)
);

// Header meta text
$key = 'entry_header_meta';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'text' ),
	)
);
$wp_customize->add_control(
	$key,
	array(
		'section'     => $section,
		'label'       => esc_html__( 'Header meta text', 'onestore' ),
		'description' => esc_html__( 'Available tags: {{date}}, {{categories}}, {{tags}}, {{author}}, {{avatar}}, {{comments}}.', 'onestore' ),
		'priority'    => 40,
	)
);

/**
 * ====================================================
 * Content
 * ====================================================
 */

// Heading: Content
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_entry_content',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Content', 'onestore' ),
			'priority'    => 50,
		)
	)
);

// Entry excerpt length
$key = 'entry_excerpt_length';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Slider(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Excerpt words limit', 'onestore' ),
			'description' => esc_html__( 'Fill with 0 to disable excerpt.', 'onestore' ),
			'units'       => array(
				'' => array(
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
					'label' => 'wrd',
				),
			),
			'priority'    => 50,
		)
	)
);

// Read more
$key = 'entry_read_more_display';
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
		'label'       => esc_html__( 'Read more', 'onestore' ),
		'choices'     => array(
			''       => esc_html__( 'None', 'onestore' ),
			'text'   => esc_html__( 'Text', 'onestore' ),
			'button' => esc_html__( 'Button', 'onestore' ),
		),
		'priority'    => 50,
	)
);

// Read more text
$key = 'entry_read_more_text';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'text' ),
	)
);
$wp_customize->add_control(
	$key,
	array(
		'section'     => $section,
		'label'       => esc_html__( 'Read more text', 'onestore' ),
		'input_attrs' => array(
			'placeholder' => esc_html__( 'Read more', 'onestore' ),
		),
		'priority'    => 50,
	)
);

/**
 * ====================================================
 * Post Footer
 * ====================================================
 */

// Heading: Post Footer
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_entry_meta',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Post Footer', 'onestore' ),
			'priority'    => 60,
		)
	)
);

// Elements to display
$key = 'entry_footer';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'multiselect' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_Builder(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Elements to display', 'onestore' ),
			'choices'     => array(
				'footer-meta' => esc_html__( 'Footer Meta', 'onestore' ),
			),
			'layout'      => 'block',
			'priority'    => 60,
		)
	)
);

// Alignment
$key = 'entry_footer_alignment';
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
		'priority'    => 60,
	)
);

// Footer meta text
$key = 'entry_footer_meta';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'text' ),
	)
);
$wp_customize->add_control(
	$key,
	array(
		'section'     => $section,
		'label'       => esc_html__( 'Footer meta text', 'onestore' ),
		'description' => esc_html__( 'Available tags: {{date}}, {{categories}}, {{tags}}, {{author}}, {{avatar}}, {{comments}}', 'onestore' ),
		'priority'    => 60,
	)
);
