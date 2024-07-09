<?php
/**
 * Customizer sections
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( onestore_show_pro_teaser() ) {
	// OneStore Pro link.
	$wp_customize->add_section(
		new OneStore_Customize_Section_Pro_Link(
			$wp_customize,
			'onestore_section_plus_link',
			array(
				'title'       => esc_html_x( 'More Options Available in OneStore Plus', 'OneStore Plus upsell', 'onestore' ),
				'url'         => esc_url(
					add_query_arg(
						array(
							'utm_source' => 'onestore-customizer',
							'utm_medium' => 'learn-more',
							'utm_campaign' => 'theme-upsell',
						),
						ONESTORE_PLUS_URL
					)
				),
				'priority'    => 0,
			)
		)
	);

	// ------
	$wp_customize->add_section(
		new OneStore_Customize_Section_Spacer(
			$wp_customize,
			'onestore_section_spacer_pro_link',
			array(
				'priority'    => 0,
			)
		)
	);
}

// Global Settings
$panel = 'onestore_panel_global_settings';
$wp_customize->add_panel(
	$panel,
	array(
		'title'       => esc_html__( 'Global Settings', 'onestore' ),
		'priority'    => 1,
	)
);
	// Site Identity
	$wp_customize->get_section( 'title_tagline' )->panel = $panel;
	$wp_customize->get_section( 'title_tagline' )->priority = 10;

	// Homepage Settings
	$wp_customize->get_section( 'static_front_page' )->panel = $panel;
	$wp_customize->get_section( 'static_front_page' )->priority = 10;

	// ------
	$wp_customize->add_section(
		new OneStore_Customize_Section_Spacer(
			$wp_customize,
			'onestore_section_spacer_global_settings',
			array(
				'panel'       => $panel,
				'priority'    => 20,
			)
		)
	);

	// Color Palette
	$wp_customize->add_section(
		'onestore_section_color_palette',
		array(
			'title'       => esc_html__( 'Color Palette', 'onestore' ),
			'description' => '<p>' . esc_html__( 'Color palette makes it easier and faster to choose colors while designing your website.', 'onestore' ) . '</p>',
			'panel'       => $panel,
			'priority'    => 20,
		)
	);

	// Google Fonts
	$wp_customize->add_section(
		'onestore_section_google_fonts',
		array(
			'title'       => esc_html__( 'Google Fonts', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 20,
		)
	);

	// Social
	$wp_customize->add_section(
		'onestore_section_social',
		array(
			'title'       => esc_html__( 'Social Media Links', 'onestore' ),
			'description' => '<p>' . esc_html__( 'Please use full URL format with http:// or https://', 'onestore' ) . '</p>',
			'panel'       => $panel,
			'priority'    => 20,
		)
	);

	// ------
	$wp_customize->add_section(
		new OneStore_Customize_Section_Spacer(
			$wp_customize,
			'onestore_section_spacer_170',
			array(
				'priority'    => 170,
			)
		)
	);

	// General Styles
	$panel = 'onestore_panel_general_styles';
	$wp_customize->add_panel(
		$panel,
		array(
			'title'       => esc_html__( 'General Styles', 'onestore' ),
			'priority'    => 171,
		)
	);

	// Body (Base)
	$wp_customize->add_section(
		'onestore_section_base',
		array(
			'title'       => esc_html__( 'Body (Base)', 'onestore' ),
			'description' => '<p>' . esc_html__( 'The global settings of body typography and colors.', 'onestore' ) . '</p>',
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Border & Subtitle Background
	$wp_customize->add_section(
		'onestore_section_line_subtitle',
		array(
			'title'       => esc_html__( 'Border & Subtitle Background', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Link
	$wp_customize->add_section(
		'onestore_section_link',
		array(
			'title'       => esc_html__( 'Link', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Headings (H1 - H4)
	$wp_customize->add_section(
		'onestore_section_headings',
		array(
			'title'       => esc_html__( 'Headings (H1 - H4)', 'onestore' ),
			'description' => '<p>' . esc_html__( 'Used on all H1 - H4 tags globally.', 'onestore' ) . '</p>',
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Blockquote
	$wp_customize->add_section(
		'onestore_section_blockquote',
		array(
			'title'       => esc_html__( 'Blockquote', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Form Input
	$wp_customize->add_section(
		'onestore_section_form_input',
		array(
			'title'       => esc_html__( 'Form Input', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Button
	$wp_customize->add_section(
		'onestore_section_button',
		array(
			'title'       => esc_html__( 'Button', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Title
	$wp_customize->add_section(
		'onestore_section_title',
		array(
			'title'       => esc_html__( 'Title', 'onestore' ),
			'description' => '<p>' . esc_html__( 'Used on Default Post title and Static Page title. By default, it uses H1 styles.', 'onestore' ) . '</p>',
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Small Title
	$wp_customize->add_section(
		'onestore_section_small_title',
		array(
			'title'       => esc_html__( 'Small Title', 'onestore' ),
			'description' => '<p>' . esc_html__( 'Used on Grid Post title, and other subsidiary headings like "Leave a Reply", "2 Comments", etc. By default, it uses H3 styles.', 'onestore' ) . '</p>',
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Meta Info
	$wp_customize->add_section(
		'onestore_section_meta',
		array(
			'title'       => esc_html__( 'Meta Info', 'onestore' ),
			'description' => '<p>' . esc_html__( 'Used on Post meta, Widget meta, Comments meta, and other small info text.', 'onestore' ) . '</p>',
			'panel'       => $panel,
			'priority'    => 10,
		)
	);



	// Header
	$panel = 'onestore_panel_header';
	$switcher = '
<div class="onestore-responsive-switcher nav-tab-wrapper wp-clearfix">
	<a href="#" class="nav-tab preview-desktop onestore-responsive-switcher-button" data-device="desktop">
		<span class="dashicons dashicons-desktop"></span>
		<span>' . esc_html__( 'Desktop', 'onestore' ) . '</span>
	</a>
	<a href="#" class="nav-tab preview-tablet preview-mobile onestore-responsive-switcher-button" data-device="tablet">
		<span class="dashicons dashicons-smartphone"></span>
		<span>' . esc_html__( 'Tablet / Mobile', 'onestore' ) . '</span>
	</a>
</div>
';
	$wp_customize->add_panel(
		$panel,
		array(
			'title'       => esc_html__( 'Header', 'onestore' ),
			'description' => $switcher,
			'priority'    => 173,
		)
	);

	// Header Builder
	$wp_customize->add_section(
		'onestore_section_header_builder',
		array(
			'title'       => esc_html__( 'Header Builder', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// ------
	$wp_customize->add_section(
		new OneStore_Customize_Section_Spacer(
			$wp_customize,
			'onestore_section_spacer_header_bars',
			array(
				'panel'       => $panel,
				'priority'    => 10,
			)
		)
	);

	// Top Bar
	$wp_customize->add_section(
		'onestore_section_header_top_bar',
		array(
			'title'       => esc_html__( 'Top Bar', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Main Bar
	$wp_customize->add_section(
		'onestore_section_header_main_bar',
		array(
			'title'       => esc_html__( 'Main Bar', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// Bottom Bar
	$wp_customize->add_section(
		'onestore_section_header_bottom_bar',
		array(
			'title'       => esc_html__( 'Bottom Bar', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 10,
		)
	);

	// ------
	$wp_customize->add_section(
		new OneStore_Customize_Section_Spacer(
			$wp_customize,
			'onestore_section_spacer_header_mobile_bars',
			array(
				'panel'       => $panel,
				'priority'    => 20,
			)
		)
	);

	// Mobile Main Bar
	$wp_customize->add_section(
		'onestore_section_header_mobile_main_bar',
		array(
			'title'       => esc_html__( 'Mobile Main Bar', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 20,
		)
	);

	// Mobile Drawer
	$wp_customize->add_section(
		'onestore_section_header_mobile_vertical_bar',
		array(
			'title'       => esc_html__( 'Mobile Drawer (Popup)', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 20,
		)
	);

	// ------
	$wp_customize->add_section(
		new OneStore_Customize_Section_Spacer(
			$wp_customize,
			'onestore_section_spacer_header_elements',
			array(
				'panel'       => $panel,
				'priority'    => 40,
			)
		)
	);

	// Logo
	$wp_customize->add_section(
		'onestore_section_header_logo',
		array(
			'title'       => esc_html__( 'Element: Logo', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 40,
		)
	);

	// Search.
	$wp_customize->add_section(
		'onestore_section_header_search',
		array(
			'title'       => esc_html__( 'Element: Search', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 40,
		)
	);


	// Header cart.
	$wp_customize->add_section(
		'onestore_section_header_cart',
		array(
			'title'       => esc_html__( 'Element: Shopping Cart', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 40,
		)
	);

	// Header account.
	$wp_customize->add_section(
		'onestore_section_header_account',
		array(
			'title'       => esc_html__( 'Element: Account', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 40,
		)
	);


	// HTML.
	$wp_customize->add_section(
		'onestore_section_header_html',
		array(
			'title'       => esc_html__( 'Element: HTML(s)', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 40,
		)
	);

	// Buttons.
	$wp_customize->add_section(
		'onestore_section_header_button',
		array(
			'title'       => esc_html__( 'Element: Button(s)', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 40,
		)
	);

	// Social.
	$wp_customize->add_section(
		'onestore_section_header_social',
		array(
			'title'       => esc_html__( 'Element: Social', 'onestore' ),
			'panel'       => $panel,
			'priority'    => 40,
		)
	);

	// ------
	$wp_customize->add_section(
		new OneStore_Customize_Section_Spacer(
			$wp_customize,
			'onestore_section_spacer_header_plus',
			array(
				'panel'       => $panel,
				'priority'    => 50,
			)
		)
	);


		// Page Header
		$wp_customize->add_section(
			'onestore_section_page_header',
			array(
				'title'       => esc_html__( 'Page Header', 'onestore' ),
				'description' => esc_html__( 'Page Header is a section located between Header and Content section and used to display the title of current page.', 'onestore' ),
				'priority'    => 174,
			)
		);

		// Content & Sidebar.
		$panel = 'onestore_panel_layout';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'       => esc_html__( 'Layout', 'onestore' ),
				'priority'    => 172,
			)
		);

		// Page Canvas & Wrapper.
		$wp_customize->add_section(
			'onestore_section_page_container',
			array(
				'title'       => esc_html__( 'Wrapper', 'onestore' ),
				'priority'    => 5,
				'panel'       => $panel,
			)
		);

		// Content Section.
		$wp_customize->add_section(
			'onestore_section_content_sidebar',
			array(
				'title'       => esc_html__( 'Content & Sidebar', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 10,
			)
		);

		// ------
		$wp_customize->add_section(
			new OneStore_Customize_Section_Spacer(
				$wp_customize,
				'onestore_section_spacer_content',
				array(
					'panel'       => $panel,
					'priority'    => 10,
				)
			)
		);

		// Main Content Area
		$wp_customize->add_section(
			'onestore_section_main',
			array(
				'title'       => esc_html__( 'Main Content Area', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 10,
			)
		);

		// Sidebar Area
		$wp_customize->add_section(
			'onestore_section_sidebar',
			array(
				'title'       => esc_html__( 'Sidebar Area', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 10,
			)
		);

		// Footer
		$panel = 'onestore_panel_footer';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'       => esc_html__( 'Footer', 'onestore' ),
				'priority'    => 176,
			)
		);

		// Footer Builder
		$wp_customize->add_section(
			'onestore_section_footer_builder',
			array(
				'title'       => esc_html__( 'Footer Builder', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 10,
			)
		);

		// ------
		$wp_customize->add_section(
			new OneStore_Customize_Section_Spacer(
				$wp_customize,
				'onestore_section_spacer_footer_bars',
				array(
					'panel'       => $panel,
					'priority'    => 10,
				)
			)
		);

		// Widgets Bar
		$wp_customize->add_section(
			'onestore_section_footer_widgets_bar',
			array(
				'title'       => esc_html__( 'Widgets Bar', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 20,
			)
		);

		// Bottom Bar
		$wp_customize->add_section(
			'onestore_section_footer_bottom_bar',
			array(
				'title'       => esc_html__( 'Bottom Bar', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 20,
			)
		);

		// ------
		$wp_customize->add_section(
			new OneStore_Customize_Section_Spacer(
				$wp_customize,
				'onestore_section_spacer_footer_elements',
				array(
					'panel'       => $panel,
					'priority'    => 30,
				)
			)
		);

		// Copyright
		$wp_customize->add_section(
			'onestore_section_footer_copyright',
			array(
				'title'       => esc_html__( 'Element: Copyright', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 30,
			)
		);

		// Social
		$wp_customize->add_section(
			'onestore_section_footer_social',
			array(
				'title'       => esc_html__( 'Element: Social', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 30,
			)
		);

		// ------
		$wp_customize->add_section(
			new OneStore_Customize_Section_Spacer(
				$wp_customize,
				'onestore_section_spacer_scroll_to_top',
				array(
					'panel'       => $panel,
					'priority'    => 40,
				)
			)
		);

		// Scroll To Top
		$wp_customize->add_section(
			'onestore_section_scroll_to_top',
			array(
				'title'       => esc_html__( 'Scroll To Top', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 40,
			)
		);

		// ------
		$wp_customize->add_section(
			new OneStore_Customize_Section_Spacer(
				$wp_customize,
				'onestore_section_spacer_180',
				array(
					'priority'    => 180,
				)
			)
		);

		// Blog
		$panel = 'onestore_panel_blog';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'       => esc_html__( 'Blog', 'onestore' ),
				'priority'    => 181,
			)
		);

		// Post Index
		$wp_customize->add_section(
			'onestore_section_blog_index',
			array(
				'title'       => esc_html__( 'Posts Page', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 10,
			)
		);

		// Post Layout: Default
		$wp_customize->add_section(
			'onestore_section_entry_default',
			array(
				'title'       => esc_html__( 'Post Layout: List', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 10,
			)
		);

		// Post Layout: Grid
		$wp_customize->add_section(
			'onestore_section_entry_grid',
			array(
				'title'       => esc_html__( 'Post Layout: Grid', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 10,
			)
		);

		// Single Post
		$wp_customize->add_section(
			'onestore_section_blog_single',
			array(
				'title'       => esc_html__( 'Single Post Page', 'onestore' ),
				'panel'       => $panel,
				'priority'    => 20,
			)
		);

		// ------
		$wp_customize->add_section(
			new OneStore_Customize_Section_Spacer(
				$wp_customize,
				'onestore_section_spacer_blog_plus',
				array(
					'panel'       => $panel,
					'priority'    => 30,
				)
			)
		);

		// ------
		$wp_customize->add_section(
			new OneStore_Customize_Section_Spacer(
				$wp_customize,
				'onestore_section_spacer_190',
				array(
					'priority'    => 190,
				)
			)
		);

		// Dynamic Page Settings.
		$panel = 'onestore_panel_page_settings';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'       => esc_html__( 'Dynamic Page Settings', 'onestore' ),
				'description' => '<p>' . esc_html__( 'You can set different layout settings (like Header, Page Header, Content, Sidebar, and Footer) on each different page type.', 'onestore' ) . '</p>',
				'priority'    => 191,
			)
		);

		// Begin registering sections.
		$i = 10;
		foreach ( OneStore_Customizer::instance()->get_all_page_settings_types() as $ps_type => $ps_data ) {
			if ( 0 < strpos( $ps_type, '_archive' ) ) {
				$wp_customize->add_section(
					new OneStore_Customize_Section_Spacer(
						$wp_customize,
						'onestore_section_spacer_page_settings_' . $i,
						array(
							'panel'       => $panel,
							'priority'    => $i,
						)
					)
				);
			}

			$desc = onestore_array_value( $ps_data, 'description' );

			$wp_customize->add_section(
				'onestore_section_page_settings_' . $ps_type,
				array(
					'title'       => onestore_array_value( $ps_data, 'title' ),
					'description' => ! empty( $desc ) ? '<p>' . $desc . '</p>' : '',
					'panel'       => $panel,
					'priority'    => $i,
				)
			);

			$i += 10;
		}
