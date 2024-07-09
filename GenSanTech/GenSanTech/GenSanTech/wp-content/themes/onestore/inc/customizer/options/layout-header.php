<?php
// phpcs:ignore WPThemeReview.Templates.ReservedFileNamePrefix.ReservedTemplatePrefixFound
/**
 * Customizer settings: Page Header
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_page_header';

/**
 * ====================================================
 * Enable / Disable
 * ====================================================
 */

// Notice Dynamic Page Settings
$wp_customize->add_control(
	new OneStore_Customize_Control_Blank(
		$wp_customize,
		'notice_page_header',
		array(
			'section'     => $section,
			'settings'    => array(),
			'description' => '<div class="notice notice-info notice-alt inline"><p>' . sprintf(
				/* translators: %1$s: section name, %2$s: link to Dynamic Page Settings. */
				esc_html__( 'You can set different %1$s setting on each page using the %2$s.', 'onestore' ),
				esc_html__( 'Page Header', 'onestore' ),
				'<a href="' . esc_url( add_query_arg( 'autofocus[panel]', 'onestore_panel_page_settings', remove_query_arg( 'autofocus' ) ) ) . '" class="onestore-customize-goto-control">' . esc_html__( 'Dynamic Page Settings', 'onestore' ) . '</a>'
			) . '</p></div>',
			'priority'    => 10,
		)
	)
);

// Enable Page Header.
$key = 'page_header';
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
			'label'       => esc_html__( 'Enable Page Header', 'onestore' ),
			'priority'    => 10,
		)
	)
);

/**
 * ====================================================
 * Builder
 * ====================================================
 */

// Heading: Elements
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_page_header_elements',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Elements', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Elements to display
$settings = array(
	'left'    => 'page_header_elements_left',
	'center'  => 'page_header_elements_center',
	'right'   => 'page_header_elements_right',
);
foreach ( $settings as $key ) {
	$wp_customize->add_setting(
		$key,
		array(
			'default'     => onestore_array_value( $defaults, $key ),
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'multiselect' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Builder(
		$wp_customize,
		'page_header_elements',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Page header elements', 'onestore' ),
			'choices'     => array(
				'title'      => esc_html__( 'Post / Page Title', 'onestore' ),
				'breadcrumb' => esc_html__( 'Breadcrumb', 'onestore' ),
			),
			'labels'      => array(
				'left'    => is_rtl() ? esc_html__( 'Right', 'onestore' ) : esc_html__( 'Left', 'onestore' ),
				'center'  => esc_html__( 'Center', 'onestore' ),
				'right'   => is_rtl() ? esc_html__( 'Left', 'onestore' ) : esc_html__( 'Right', 'onestore' ),
			),
			'layout'      => 'block',
			'priority'    => 20,
		)
	)
);

// Post / Page Title
$wp_customize->add_control(
	new OneStore_Customize_Control_Blank(
		$wp_customize,
		'note_page_header_title',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Post / Page Title', 'onestore' ),
			'description' => sprintf(
				/* translators: %s: link to Dynamic Page Settings. */
				esc_html__( 'Show the title of current page, whether it\'s a static page, a single post page, or an archive page. You can change the title text format for search results and archive pages via %s.', 'onestore' ),
				'<a href="' . esc_url( add_query_arg( 'autofocus[panel]', 'onestore_panel_page_settings', remove_query_arg( 'autofocus' ) ) ) . '" class="onestore-customize-goto-control">' . esc_html__( 'Dynamic Page Settings', 'onestore' ) . '</a>'
			),
			'priority'    => 20,
		)
	)
);

// Breadcrumb plugin
$key = 'breadcrumb_plugin';
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
		'label'       => esc_html__( 'Breadcrumb', 'onestore' ),
		'description' => esc_html__( 'To enable breadcrumb feature, you need to install one of the following plugins and enable the breadcrumb feature on the plugin\'s settings page.', 'onestore' ),
		'choices'     => array(
			'default'        => esc_html__( 'Default', 'onestore' ),
			'rank-math'        => esc_html__( 'Rank Math', 'onestore' ),
			'seopress'         => esc_html__( 'SEOPress (pro version)', 'onestore' ),
			'yoast-seo'        => esc_html__( 'Yoast SEO', 'onestore' ),
			'breadcrumb-navxt' => esc_html__( 'Breadcrumb NavXT', 'onestore' ),
			'breadcrumb-trail' => esc_html__( 'Breadcrumb Trail', 'onestore' ),
		),
		'priority'    => 20,
	)
);

/**
 * ====================================================
 * Layout
 * ====================================================
 */

// Heading: Layout
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_page_header_layout',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Layout', 'onestore' ),
			'priority'    => 30,
		)
	)
);

// Padding.
$key = 'page_header_padding';
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
$key = 'page_header_border';
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
		'heading_page_header_typography',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Typography', 'onestore' ),
			'priority'    => 40,
		)
	)
);

// Post / page title typography.
$settings = array(
	'font_family'    => 'page_header_title_font_family',
	'font_weight'    => 'page_header_title_font_weight',
	'font_style'     => 'page_header_title_font_style',
	'text_transform' => 'page_header_title_text_transform',
	'font_size'      => 'page_header_title_font_size',
	'line_height'    => 'page_header_title_line_height',
	'letter_spacing' => 'page_header_title_letter_spacing',

	'font_size__tablet'      => 'page_header_title_font_size__tablet',
	'line_height__tablet'    => 'page_header_title_line_height__tablet',
	'letter_spacing__tablet' => 'page_header_title_letter_spacing__tablet',

	'font_size__mobile'      => 'page_header_title_font_size__mobile',
	'line_height__mobile'    => 'page_header_title_line_height__mobile',
	'letter_spacing__mobile' => 'page_header_title_letter_spacing__mobile',
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
		'page_header_title_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Post / page title typography', 'onestore' ),
			'priority'    => 40,
		)
	)
);

// Breadcrumb typography
$settings = array(
	'font_family'    => 'page_header_breadcrumb_font_family',
	'font_weight'    => 'page_header_breadcrumb_font_weight',
	'font_style'     => 'page_header_breadcrumb_font_style',
	'text_transform' => 'page_header_breadcrumb_text_transform',
	'font_size'      => 'page_header_breadcrumb_font_size',
	'line_height'    => 'page_header_breadcrumb_line_height',
	'letter_spacing' => 'page_header_breadcrumb_letter_spacing',

	'font_size__tablet'      => 'page_header_breadcrumb_font_size__tablet',
	'line_height__tablet'    => 'page_header_breadcrumb_line_height__tablet',
	'letter_spacing__tablet' => 'page_header_breadcrumb_letter_spacing__tablet',

	'font_size__mobile'      => 'page_header_breadcrumb_font_size__mobile',
	'line_height__mobile'    => 'page_header_breadcrumb_line_height__mobile',
	'letter_spacing__mobile' => 'page_header_breadcrumb_letter_spacing__mobile',
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
		'page_header_breadcrumb_typography',
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Breadcrumb typography', 'onestore' ),
			'priority'    => 40,
		)
	)
);

/**
 * ====================================================
 * Colors
 * ====================================================
 */

// Heading: Colors.
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_page_header_colors',
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
	'page_header_bg_color'                         => esc_html__( 'Background color', 'onestore' ),
	'page_header_border_color'                     => esc_html__( 'Border color', 'onestore' ),
	'page_header_title_text_color'                 => esc_html__( 'Post / page title text color', 'onestore' ),
	'page_header_breadcrumb_text_color'            => esc_html__( 'Breadcrumb text color', 'onestore' ),
	'page_header_breadcrumb_link_text_color'       => esc_html__( 'Breadcrumb link text color', 'onestore' ),
	'page_header_breadcrumb_link_hover_text_color' => esc_html__( 'Breadcrumb link text color :hover', 'onestore' ),
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

/**
 * ====================================================
 * Background
 * ====================================================
 */

// Heading: Background Image (Global Default)
$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_page_header_background',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Background Image (Global Default)', 'onestore' ),
			'priority'    => 60,
		)
	)
);

// Background image
$key = 'page_header_bg_image';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'image' ),
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Background image', 'onestore' ),
			'mime_type'   => 'image',
			'priority'    => 60,
		)
	)
);

// Background attachment
$key = 'page_header_bg_attachment';
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
		'label'       => esc_html__( 'Background attachment', 'onestore' ),
		'choices'     => array(
			'scroll' => esc_html__( 'Scroll', 'onestore' ),
			'fixed'  => esc_html__( 'Fixed', 'onestore' ),
		),
		'priority'    => 60,
	)
);

// Colors.
$key = 'page_header_bg_overlay_color';
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
			'label'       => esc_html__( 'Background overlay color', 'onestore' ),
			'priority'    => 60,
		)
	)
);
