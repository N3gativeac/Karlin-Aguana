<?php
/**
 * Customizer settings: Header > Header Builder
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$section = 'onestore_section_header_builder';

/**
 * ====================================================
 * Builder
 * ====================================================
 */

ob_start(); ?>
<div class="onestore-responsive-switcher nav-tab-wrapper wp-clearfix">
	<a href="#" class="nav-tab preview-desktop onestore-responsive-switcher-button" data-device="desktop">
		<span class="dashicons dashicons-desktop"></span>
		<span><?php esc_html_e( 'Desktop', 'onestore' ); ?></span>
	</a>
	<a href="#" class="nav-tab preview-tablet preview-mobile onestore-responsive-switcher-button" data-device="tablet">
		<span class="dashicons dashicons-smartphone"></span>
		<span><?php esc_html_e( 'Tablet / Mobile', 'onestore' ); ?></span>
	</a>
</div>
<span class="button button-secondary onestore-builder-hide onestore-builder-toggle"><span class="dashicons dashicons-no"></span><?php esc_html_e( 'Hide', 'onestore' ); ?></span>
<span class="button button-primary onestore-builder-show onestore-builder-toggle"><span class="dashicons dashicons-edit"></span><?php esc_html_e( 'Header Builder', 'onestore' ); ?></span>
<?php $switcher = ob_get_clean();

// --- Blank: Header Builder Switcher
$wp_customize->add_control(
	new OneStore_Customize_Control_Blank(
		$wp_customize,
		'header_builder_actions',
		array(
			'section'     => $section,
			'settings'    => array(),
			'description' => $switcher,
			'priority'    => 10,
		)
	)
);

// Desktop Header
$key = 'header_elements';
$settings = array(
	'top_left'      => $key . '_top_left',
	'top_center'    => $key . '_top_center',
	'top_right'     => $key . '_top_right',
	'main_left'     => $key . '_main_left',
	'main_center'   => $key . '_main_center',
	'main_right'    => $key . '_main_right',
	'bottom_left'   => $key . '_bottom_left',
	'bottom_center' => $key . '_bottom_center',
	'bottom_right'  => $key . '_bottom_right',
);
foreach ( $settings as $setting ) {
	$wp_customize->add_setting(
		$setting,
		array(
			'default'     => onestore_array_value( $defaults, $setting ),
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'builder' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Builder(
		$wp_customize,
		$key,
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Desktop Header', 'onestore' ),
			'choices'     => apply_filters(
				'onestore/header_builder/desktop_items',
				array(
					'logo'                   => '<span class="dashicons dashicons-admin-home"></span>' . esc_html__( 'Logo', 'onestore' ),
					/* translators: %s: instance number. */
					'menu-1'                 => '<span class="dashicons dashicons-admin-links"></span>' . sprintf( esc_html__( 'Menu %s', 'onestore' ), 1 ),

					'search-bar'             => '<span class="dashicons dashicons-search"></span>' . esc_html__( 'Search Bar', 'onestore' ),
					'search-dropdown'        => '<span class="dashicons dashicons-search"></span>' . esc_html__( 'Search Dropdown', 'onestore' ),
					'shopping-cart-link'     => '<span class="dashicons dashicons-cart"></span>' . esc_html__( 'Cart Link', 'onestore' ),
					'shopping-cart'          => '<span class="dashicons dashicons-cart"></span>' . esc_html__( 'Cart', 'onestore' ),
					'account'                => '<span class="dashicons dashicons-cart"></span>' . esc_html__( 'Account', 'onestore' ),
					'social'                 => '<span class="dashicons dashicons-twitter"></span>' . esc_html__( 'Social', 'onestore' ),
					'mobile-vertical-toggle' => '<span class="dashicons dashicons-menu"></span>' . esc_html__( 'Toggle', 'onestore' ),

					/* translators: %s: instance number. */
					'html-1'                 => '<span class="dashicons dashicons-editor-code"></span>' . sprintf( esc_html__( 'HTML %s', 'onestore' ), 1 ),
					'html-2'                 => '<span class="dashicons dashicons-editor-code"></span>' . sprintf( esc_html__( 'HTML %s', 'onestore' ), 2 ),
					'html-3'                 => '<span class="dashicons dashicons-editor-code"></span>' . sprintf( esc_html__( 'HTML %s', 'onestore' ), 3 ),
					'html-4'                 => '<span class="dashicons dashicons-editor-code"></span>' . sprintf( esc_html__( 'HTML %s', 'onestore' ), 4 ),
					'html-5'                 => '<span class="dashicons dashicons-editor-code"></span>' . sprintf( esc_html__( 'HTML %s', 'onestore' ), 5 ),

					'button-1'                 => '<span class="dashicons dashicons-editor-links"></span>' . sprintf( esc_html__( 'Button %s', 'onestore' ), 1 ),
					'button-2'                 => '<span class="dashicons dashicons-editor-links"></span>' . sprintf( esc_html__( 'Button %s', 'onestore' ), 2 ),
					'button-3'                 => '<span class="dashicons dashicons-editor-links"></span>' . sprintf( esc_html__( 'Button %s', 'onestore' ), 3 ),
					'button-4'                 => '<span class="dashicons dashicons-editor-links"></span>' . sprintf( esc_html__( 'Button %s', 'onestore' ), 4 ),
					'button-5'                 => '<span class="dashicons dashicons-editor-links"></span>' . sprintf( esc_html__( 'Button %s', 'onestore' ), 5 ),

				)
			),
			'labels'      => array(
				'top_left'      => is_rtl() ? esc_html__( 'Top - Right', 'onestore' ) : esc_html__( 'Top - Left', 'onestore' ),
				'top_center'    => esc_html__( 'Top - Center', 'onestore' ),
				'top_right'     => is_rtl() ? esc_html__( 'Top - Left', 'onestore' ) : esc_html__( 'Top - Right', 'onestore' ),
				'main_left'     => is_rtl() ? esc_html__( 'Main - Right', 'onestore' ) : esc_html__( 'Main - Left', 'onestore' ),
				'main_center'   => esc_html__( 'Main - Center', 'onestore' ),
				'main_right'    => is_rtl() ? esc_html__( 'Main - Left', 'onestore' ) : esc_html__( 'Main - Right', 'onestore' ),
				'bottom_left'   => is_rtl() ? esc_html__( 'Bottom - Right', 'onestore' ) : esc_html__( 'Bottom - Left', 'onestore' ),
				'bottom_center' => esc_html__( 'Bottom - Center', 'onestore' ),
				'bottom_right'  => is_rtl() ? esc_html__( 'Bottom - Left', 'onestore' ) : esc_html__( 'Bottom - Right', 'onestore' ),
			),
			'priority'    => 10,
		)
	)
);

// Mobile Header
$key = 'header_mobile_elements';
$settings = array(
	'mobile_main_left'    => $key . '_main_left',
	'mobile_main_center'  => $key . '_main_center',
	'mobile_main_right'   => $key . '_main_right',
	'mobile_vertical_top' => $key . '_vertical_top',
);
foreach ( $settings as $setting ) {
	$wp_customize->add_setting(
		$setting,
		array(
			'default'     => onestore_array_value( $defaults, $setting ),
			'sanitize_callback' => array( 'OneStore_Customizer_Sanitization', 'builder' ),
		)
	);
}
$wp_customize->add_control(
	new OneStore_Customize_Control_Builder(
		$wp_customize,
		$key,
		array(
			'settings'    => $settings,
			'section'     => $section,
			'label'       => esc_html__( 'Mobile Header', 'onestore' ),
			'choices'     => apply_filters(
				'onestore/header_builder/mobile_items',
				array(
					'mobile-logo'            => '<span class="dashicons dashicons-admin-home"></span>' . esc_html__( 'Mobile Logo', 'onestore' ),
					'mobile-menu'            => '<span class="dashicons dashicons-admin-links"></span>' . esc_html__( 'Mobile Menu', 'onestore' ),

					'search-bar'             => '<span class="dashicons dashicons-search"></span>' . esc_html__( 'Search Bar', 'onestore' ),
					'search-dropdown'        => '<span class="dashicons dashicons-search"></span>' . esc_html__( 'Search Icon', 'onestore' ),
					'shopping-cart-link'     => '<span class="dashicons dashicons-cart"></span>' . esc_html__( 'Cart Link', 'onestore' ),
					'shopping-cart'          => '<span class="dashicons dashicons-cart"></span>' . esc_html__( 'Cart', 'onestore' ),
					'account'                => '<span class="dashicons-admin-users"></span>' . esc_html__( 'Account', 'onestore' ),
					'social'                 => '<span class="dashicons dashicons-twitter"></span>' . esc_html__( 'Social', 'onestore' ),
					'mobile-vertical-toggle' => '<span class="dashicons dashicons-menu"></span>' . esc_html__( 'Toggle', 'onestore' ),

					/* translators: %s: instance number. */
					'html-1'                 => '<span class="dashicons dashicons-editor-code"></span>' . sprintf( esc_html__( 'HTML %s', 'onestore' ), 1 ),
					'html-2'                 => '<span class="dashicons dashicons-editor-code"></span>' . sprintf( esc_html__( 'HTML %s', 'onestore' ), 2 ),
					'html-3'                 => '<span class="dashicons dashicons-editor-code"></span>' . sprintf( esc_html__( 'HTML %s', 'onestore' ), 3 ),
					'html-4'                 => '<span class="dashicons dashicons-editor-code"></span>' . sprintf( esc_html__( 'HTML %s', 'onestore' ), 4 ),
					'html-5'                 => '<span class="dashicons dashicons-editor-code"></span>' . sprintf( esc_html__( 'HTML %s', 'onestore' ), 5 ),

					'button-1'                 => '<span class="dashicons dashicons-editor-links"></span>' . sprintf( esc_html__( 'Button %s', 'onestore' ), 1 ),
					'button-2'                 => '<span class="dashicons dashicons-editor-links"></span>' . sprintf( esc_html__( 'Button %s', 'onestore' ), 2 ),
					'button-3'                 => '<span class="dashicons dashicons-editor-links"></span>' . sprintf( esc_html__( 'Button %s', 'onestore' ), 3 ),
					'button-4'                 => '<span class="dashicons dashicons-editor-links"></span>' . sprintf( esc_html__( 'Button %s', 'onestore' ), 4 ),
					'button-5'                 => '<span class="dashicons dashicons-editor-links"></span>' . sprintf( esc_html__( 'Button %s', 'onestore' ), 5 ),
				)
			),
			'labels'      => array(
				'mobile_main_left'    => is_rtl() ? esc_html__( 'Right', 'onestore' ) : esc_html__( 'Left', 'onestore' ),
				'mobile_main_center'  => esc_html__( 'Center', 'onestore' ),
				'mobile_main_right'   => is_rtl() ? esc_html__( 'Left', 'onestore' ) : esc_html__( 'Right', 'onestore' ),
				'mobile_vertical_top' => esc_html__( 'Drawer (Popup)', 'onestore' ),
			),
			'limitations' => array(
				'mobile-logo'            => array( 'mobile_vertical_top' ),
				'mobile-menu'            => array( 'mobile_main_left', 'mobile_main_center', 'mobile_main_right' ),
				'search-bar'             => array( 'mobile_main_left', 'mobile_main_center', 'mobile_main_right' ),
				'search-dropdown'        => array( 'mobile_vertical_top' ),
				'shopping-cart-link'     => array( 'mobile_vertical_top' ),
				'mobile-vertical-toggle' => array( 'mobile_vertical_top' ),
			),
			'priority'    => 10,
		)
	)
);
