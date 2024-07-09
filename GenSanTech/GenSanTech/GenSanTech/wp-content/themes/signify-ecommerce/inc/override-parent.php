<?php
/*
 * Override parent functions.
 */

if ( ! function_exists( 'signify_sections' ) ) :
/**
 * Add Woo Products Showcase before portfolio
 */
function signify_sections( $selector = 'header' ) {
	get_template_part( 'template-parts/header/header-media' );
	get_template_part( 'template-parts/slider/display-slider' );
	get_template_part( 'template-parts/woo-products-showcase/display-products' );
	get_template_part( 'template-parts/service/display-service' );
	get_template_part( 'template-parts/hero-content/content-hero' );
	get_template_part( 'template-parts/portfolio/display-portfolio' );
	get_template_part( 'template-parts/featured-content/display-featured' );
	get_template_part( 'template-parts/testimonial/display-testimonial' );
}
endif;

if ( ! function_exists( 'signify_get_theme_layout' ) ) :
/**
 * Add WooCommerce Layout check in layouts
 *
 * @since 1.0.0
 */
function signify_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = get_theme_mod( 'signify_default_layout', 'right-sidebar' );

		if ( is_home() || is_archive() ) {
			$layout = get_theme_mod( 'signify_homepage_archive_layout', 'right-sidebar' );
		}
		if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_woocommerce() || is_cart() || is_checkout() ) ) {
			$layout = get_theme_mod( 'signify_woocommerce_layout', 'no-sidebar' );
		}
	}

	return $layout;
}
endif; // signify_get_theme_layout
