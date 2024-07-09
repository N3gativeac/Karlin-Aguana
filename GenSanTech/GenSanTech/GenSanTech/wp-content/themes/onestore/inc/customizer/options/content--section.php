<?php
/**
 * Customizer settings: Content & Sidebar > Content Section
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_content_sidebar';

/**
 * ====================================================
 * Layout
 * ====================================================
 */

// Notice Dynamic Page Settings
$wp_customize->add_control(
	new OneStore_Customize_Control_Blank(
		$wp_customize,
		'notice_content_layout',
		array(
			'section'     => $section,
			'settings'    => array(),
			'description' => '<div class="notice notice-info notice-alt inline"><p>' . sprintf(
				/* translators: %1$s: section name, %2$s: link to Dynamic Page Settings. */
				esc_html__( 'You can set different %1$s setting on each page using the %2$s.', 'onestore' ),
				esc_html__( 'Content Section', 'onestore' ),
				'<a href="' . esc_url( add_query_arg( 'autofocus[panel]', 'onestore_panel_page_settings', remove_query_arg( 'autofocus' ) ) ) . '" class="onestore-customize-goto-control">' . esc_html__( 'Dynamic Page Settings', 'onestore' ) . '</a>'
			) . '</p></div>',
			'priority'    => 10,
		)
	)
);


// Content & sidebar layout.
$key = 'content_layout';
$wp_customize->add_setting(
	$key,
	array(
		'default'     => onestore_array_value( $defaults, $key ),
		'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'select' ),
	)
);
$wp_customize->add_control(
	new OneStore_Customize_Control_RadioImage(
		$wp_customize,
		$key,
		array(
			'section'     => $section,
			'label'       => esc_html__( 'Content & sidebar layout', 'onestore' ),
			'choices'     => array(
				'wide'          => array(
					'label' => esc_html__( 'Wide', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/content-sidebar-layout--wide.svg',
				),
				'left-sidebar'  => array(
					'label' => is_rtl() ? esc_html__( 'Right sidebar', 'onestore' ) : esc_html__( 'Left sidebar', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/content-sidebar-layout--left-sidebar.svg',
				),
				'right-sidebar' => array(
					'label' => is_rtl() ? esc_html__( 'Left sidebar', 'onestore' ) : esc_html__( 'Right sidebar', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/content-sidebar-layout--right-sidebar.svg',
				),
			),
			'priority'    => 10,
		)
	)
);

