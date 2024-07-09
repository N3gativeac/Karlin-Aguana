<?php
/**
 * Customizer settings:
 * - Header > Top Bar
 * - Header > Main Bar
 * - Header > Bottom Bar
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

foreach ( array( 'top_bar', 'main_bar', 'bottom_bar' ) as $bar ) {

	$section = 'onestore_section_header_' . $bar;

	/**
	 * ====================================================
	 * Layout
	 * ====================================================
	 */

	if ( $bar !== 'main_bar' ) {
		// Merge inside Main Bar
		$key = 'header_' . $bar . '_merged';
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
					'label'       => esc_html__( 'Merge inside Main Bar wrapper', 'onestore' ),
					'priority'    => 10,
				)
			)
		);

		// Merged gap.
		$key = 'header_' . $bar . '_merged_gap';
		$wp_customize->add_setting(
			$key,
			array(
				'default'     => onestore_array_value( $defaults, $key ),
				'transport'   => 'postMessage',
				'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'dimension' ),
			)
		);
		$wp_customize->add_control(
			new OneStore_Customize_Control_Dimension(
				$wp_customize,
				$key,
				array(
					'section'     => $section,
					'label'       => esc_html__( 'Gap with Main Bar content', 'onestore' ),
					'units'       => array(
						'px' => array(
							'min'   => 0,
							'step'  => 1,
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
				'hr_header_' . $bar . '_merged',
				array(
					'section'     => $section,
					'settings'    => array(),
					'priority'    => 10,
				)
			)
		);
	}

	// Layout
	$key = 'header_' . $bar . '_container';
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
						'image' => ONESTORE_IMAGES_URL . '/customizer/header-container--default.svg',
					),
					'full-width' => array(
						'label' => esc_html__( 'Full width', 'onestore' ),
						'image' => ONESTORE_IMAGES_URL . '/customizer/header-container--full-width.svg',
					),
					'contained'  => array(
						'label' => esc_html__( 'Contained', 'onestore' ),
						'image' => ONESTORE_IMAGES_URL . '/customizer/header-container--contained.svg',
					),
				),
				'priority'    => 10,
			)
		)
	);

	// Height.
	$key = 'header_' . $bar . '_height';
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
				'label'       => esc_html__( 'Height', 'onestore' ),
				'units'       => array(
					'px' => array(
						'min'   => 20,
						'max'   => 300,
						'step'  => 1,
					),
				),
				'priority'    => 10,
			)
		)
	);

	if ( 'main_bar' == $bar ) {
		// Sticky header.
		$key = 'header_' . $bar . '_sticky';
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
					'label'       => esc_html__( 'Enable Sticky', 'onestore' ),
					'priority'    => 10,
				)
			)
		);

	}

	// Padding.
	$key = 'header_' . $bar . '_padding';
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

	// Border
	$key = 'header_' . $bar . '_border';
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

	// Items gutter
	$key = 'header_' . $bar . '_items_gutter';
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

	// Heading: Typography
	$wp_customize->add_control(
		new OneStore_Customize_Control_Heading(
			$wp_customize,
			'heading_header_' . $bar . '_typography',
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
		'font_family'    => 'header_' . $bar . '_font_family',
		'font_weight'    => 'header_' . $bar . '_font_weight',
		'font_style'     => 'header_' . $bar . '_font_style',
		'text_transform' => 'header_' . $bar . '_text_transform',
		'font_size'      => 'header_' . $bar . '_font_size',
		'line_height'    => 'header_' . $bar . '_line_height',
		'letter_spacing' => 'header_' . $bar . '_letter_spacing',
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
			'header_' . $bar . '_typography',
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
		'font_family'    => 'header_' . $bar . '_menu_font_family',
		'font_weight'    => 'header_' . $bar . '_menu_font_weight',
		'font_style'     => 'header_' . $bar . '_menu_font_style',
		'text_transform' => 'header_' . $bar . '_menu_text_transform',
		'font_size'      => 'header_' . $bar . '_menu_font_size',
		'line_height'    => 'header_' . $bar . '_menu_line_height',
		'letter_spacing' => 'header_' . $bar . '_menu_letter_spacing',
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
			'header_' . $bar . '_menu_typography',
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
		'font_family'    => 'header_' . $bar . '_submenu_font_family',
		'font_weight'    => 'header_' . $bar . '_submenu_font_weight',
		'font_style'     => 'header_' . $bar . '_submenu_font_style',
		'text_transform' => 'header_' . $bar . '_submenu_text_transform',
		'font_size'      => 'header_' . $bar . '_submenu_font_size',
		'line_height'    => 'header_' . $bar . '_submenu_line_height',
		'letter_spacing' => 'header_' . $bar . '_submenu_letter_spacing',
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
			'header_' . $bar . '_submenu_typography',
			array(
				'settings'    => $settings,
				'section'     => $section,
				'label'       => esc_html__( 'Submenu link typography', 'onestore' ),
				'priority'    => 20,
			)
		)
	);

	// Icon size
	$key = 'header_' . $bar . '_icon_size';
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
			'heading_header_' . $bar . '_colors',
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
		'header_' . $bar . '_bg_color'                  => esc_html__( 'Background color', 'onestore' ),
		'header_' . $bar . '_border_color'              => esc_html__( 'Border color', 'onestore' ),
		'header_' . $bar . '_text_color'                => esc_html__( 'Text color', 'onestore' ),
		'header_' . $bar . '_link_text_color'           => esc_html__( 'Link text color', 'onestore' ),
		'header_' . $bar . '_link_hover_text_color'     => esc_html__( 'Link text color :hover', 'onestore' ),
		'header_' . $bar . '_link_active_text_color'    => esc_html__( 'Link text color :active', 'onestore' ),
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

	// ------
	$wp_customize->add_control(
		new OneStore_Customize_Control_HR(
			$wp_customize,
			'hr_header_' . $bar . '_submenu_colors',
			array(
				'section'     => $section,
				'settings'    => array(),
				'priority'    => 30,
			)
		)
	);

	// Colors
	$colors = array(
		'header_' . $bar . '_submenu_bg_color'                  => esc_html__( 'Submenu background color', 'onestore' ),
		'header_' . $bar . '_submenu_border_color'              => esc_html__( 'Submenu border color', 'onestore' ),
		'header_' . $bar . '_submenu_text_color'                => esc_html__( 'Submenu text color', 'onestore' ),
		'header_' . $bar . '_submenu_link_text_color'           => esc_html__( 'Submenu link text color', 'onestore' ),
		'header_' . $bar . '_submenu_link_hover_text_color'     => esc_html__( 'Submenu link text color :hover', 'onestore' ),
		'header_' . $bar . '_submenu_link_active_text_color'    => esc_html__( 'Submenu link text color :active', 'onestore' ),
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

	// ------
	$wp_customize->add_control(
		new OneStore_Customize_Control_HR(
			$wp_customize,
			'hr_header_' . $bar . '_menu_highlight_colors',
			array(
				'section'     => $section,
				'settings'    => array(),
				'priority'    => 30,
			)
		)
	);

	// Top level menu items highlight
	$key = 'header_' . $bar . '_menu_highlight';
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
			'label'       => esc_html__( 'Top level menu items highlight', 'onestore' ),
			'choices'     => array(
				'none'          => esc_html__( 'None', 'onestore' ),
				'background'    => esc_html__( 'Background', 'onestore' ),
				'underline'     => esc_html__( 'Underline', 'onestore' ),
				'border-top'    => esc_html__( 'Border top', 'onestore' ),
				'border-bottom' => esc_html__( 'Border bottom', 'onestore' ),
			),
			'priority'    => 30,
		)
	);

	// Colors
	$colors = array(
		'header_' . $bar . '_menu_hover_highlight_color'       => esc_html__( 'Highlight color :hover', 'onestore' ),
		'header_' . $bar . '_menu_hover_highlight_text_color'  => esc_html__( 'Highlight text color :hover', 'onestore' ),
		'header_' . $bar . '_menu_active_highlight_color'      => esc_html__( 'Highlight color :active', 'onestore' ),
		'header_' . $bar . '_menu_active_highlight_text_color' => esc_html__( 'Highlight text color :active', 'onestore' ),
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
}
