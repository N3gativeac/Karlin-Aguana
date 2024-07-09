<?php
/**
 * Customizer settings: Blog > Posts Index
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_blog_index';

/**
 * ====================================================
 * Posts Layout
 * ====================================================
 */

// Posts layout
$key = 'blog_index_loop_mode';
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
			'label'       => esc_html__( 'Posts layout', 'onestore' ),
			'choices'     => array(
				'default' => array(
					'label' => esc_html__( 'List', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/blog-layout--default.svg',
				),
				'grid'    => array(
					'label' => esc_html__( 'Grid', 'onestore' ),
					'image' => ONESTORE_IMAGES_URL . '/customizer/blog-layout--grid.svg',
				),
			),
			'priority'    => 10,
		)
	)
);

// Navigation mode
$key = 'blog_index_navigation_mode';
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
		'label'       => esc_html__( 'Navigation mode', 'onestore' ),
		'choices'     => array(
			'prev-next'  => esc_html__( 'Prev / Next buttons', 'onestore' ),
			'pagination' => esc_html__( 'Pagination (page numbers)', 'onestore' ),
		),
		'priority'    => 15,
	)
);

// ------
$wp_customize->add_control(
	new OneStore_Customize_Control_HR(
		$wp_customize,
		'hr_blog_index_navigation',
		array(
			'section'     => $section,
			'settings'    => array(),
			'priority'    => 20,
		)
	)
);

// Edit entry
$wp_customize->add_control(
	new OneStore_Customize_Control_Blank(
		$wp_customize,
		'edit_entry',
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Edit post layout', 'onestore' ),
			'priority'    => 20,
		)
	)
);

// Edit entry default
$wp_customize->add_control(
	new OneStore_Customize_Control_Blank(
		$wp_customize,
		'edit_entry_default',
		array(
			'section'     => $section,
			'settings'    => array(),
			'description' => '<a href="' . esc_url( add_query_arg( 'autofocus[section]', 'onestore_section_entry_default', remove_query_arg( 'autofocus' ) ) ) . '" class="onestore-customize-goto-control button button-secondary">' . esc_html__( 'Post Layout: Default', 'onestore' ) . '</a>',
			'priority'    => 20,
		)
	)
);

// Edit entry grid
$wp_customize->add_control(
	new OneStore_Customize_Control_Blank(
		$wp_customize,
		'edit_entry_grid',
		array(
			'section'     => $section,
			'settings'    => array(),
			'description' => '<a href="' . esc_url( add_query_arg( 'autofocus[section]', 'onestore_section_entry_grid', remove_query_arg( 'autofocus' ) ) ) . '" class="onestore-customize-goto-control button button-secondary">' . esc_html__( 'Post Layout: Grid', 'onestore' ) . '</a>',
			'priority'    => 20,
		)
	)
);
