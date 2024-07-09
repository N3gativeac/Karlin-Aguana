<?php
/**
 * Customizer sections: WooComerce
 *
 * @package OneStore
 **/

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Panel
$panel = 'woocommerce';
$wp_customize->get_panel( $panel )->priority = 182;

// Store Notice
$wp_customize->get_section( 'woocommerce_store_notice' )->priority = 1;

// ------
$wp_customize->add_section(
	new OneStore_Customize_Section_Spacer(
		$wp_customize,
		'onestore_section_spacer_woocommerce_pages',
		array(
			'panel'       => $panel,
			'priority'    => 9,
		)
	)
);

// Products Catalog
$wp_customize->get_section( 'woocommerce_product_catalog' )->title = esc_html__( 'Shop (Products Catalog) Page', 'onestore' );

// Single Product
$wp_customize->add_section(
	'woocommerce_product_single',
	array(
		'title'       => esc_html__( 'Single Product Page', 'onestore' ),
		'panel'       => $panel,
		'priority'    => 11, // Place it under the 'Shop (Products Catalog) Page' section
	)
);

// Cart
$wp_customize->add_section(
	'woocommerce_cart',
	array(
		'title'       => esc_html__( 'Cart Page', 'onestore' ),
		'panel'       => $panel,
		'priority'    => 12, // Place it under the 'Shop (Products Catalog) Page' section
	)
);

// Checkout
$wp_customize->get_section( 'woocommerce_checkout' )->title = esc_html__( 'Checkout Page', 'onestore' );
$wp_customize->get_section( 'woocommerce_checkout' )->priority = 13;

// ------
$wp_customize->add_section(
	new OneStore_Customize_Section_Spacer(
		$wp_customize,
		'onestore_section_spacer_woocommerce_grid',
		array(
			'panel'       => $panel,
			'priority'    => 60,
		)
	)
);

// Product Images
$wp_customize->get_section( 'woocommerce_product_images' )->priority = 61;

// Products Grid
$wp_customize->add_section(
	'woocommerce_products_grid',
	array(
		'title'       => esc_html__( 'Products Grid', 'onestore' ),
		'description' => esc_html__( 'Global styles for products grid as used in main product catalog page, related products, up-sells, cross-sells, and products shortcodes.', 'onestore' ),
		'panel'       => $panel,
		'priority'    => 62,
	)
);

// Other Elements
$wp_customize->add_section(
	'onestore_section_woocommerce_elements',
	array(
		'title'       => esc_html__( 'Other Elements', 'onestore' ),
		'panel'       => $panel,
		'priority'    => 63,
	)
);

// ------
$wp_customize->add_section(
	new OneStore_Customize_Section_Spacer(
		$wp_customize,
		'onestore_section_spacer_woocommerce_others',
		array(
			'panel'       => $panel,
			'priority'    => 70,
		)
	)
);
