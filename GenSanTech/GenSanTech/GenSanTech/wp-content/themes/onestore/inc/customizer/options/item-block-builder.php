<?php

$builder_setting_key = $item_builder_args['setting_key'];
$priority = $item_builder_args['start_priority'];
$section = $item_builder_args['section'];

$wp_customize->add_control(
	new OneStore_Customize_Control_Heading(
		$wp_customize,
		'heading_' . $builder_setting_key,
		array(
			'section'     => $section,
			'settings'    => array(),
			'label'       => esc_html__( 'Item Elements', 'onestore' ),
			'priority'    => $priority,
		)
	)
);
$settings = array(
	'top'    => $builder_setting_key . '_top',
	'thumb_left'  => $builder_setting_key . '_thumb_left',
	'thumb'  => $builder_setting_key . '_thumb',
	'thumb_right'  => $builder_setting_key . '_thumb_right',
	'thumb_bottom'  => $builder_setting_key . '_thumb_bottom',
	'body_left'  => $builder_setting_key . '_body_left',
	'body'  => $builder_setting_key . '_body',
	'body_right'  => $builder_setting_key . '_body_right',
	'bottom'   => $builder_setting_key . '_bottom',
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
		$item_builder_args['setting_key'],
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Elements & Positions', 'onestore' ),
			'choices'     => $item_builder_args['items'],
			'labels'      => array(
				'top'    => esc_html__( 'Top', 'onestore' ),
				'thumb_left'  => esc_html__( 'Inside Thumbnail - Left', 'onestore' ),
				'thumb'  => esc_html__( 'Inside Thumbnail - Center', 'onestore' ),
				'thumb_right'  => esc_html__( 'Inside Thumbnail - Right', 'onestore' ),
				'thumb_bottom'  => esc_html__( 'Inside Thumbnail - Bottom', 'onestore' ),
				'body_left'  => esc_html__( 'Body - Left', 'onestore' ),
				'body'  => esc_html__( 'Body', 'onestore' ),
				'body_right'  => esc_html__( 'Body - Right', 'onestore' ),
				'bottom'   => esc_html__( 'Bottom', 'onestore' ),
			),
			'layout'      => 'block',
			'priority'    => $priority + 10,
		)
	)
);
