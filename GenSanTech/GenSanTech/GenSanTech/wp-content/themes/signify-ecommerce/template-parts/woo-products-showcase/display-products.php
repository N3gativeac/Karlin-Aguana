<?php
/**
 * The template for displaying Woo Products Showcase
 *
 * @package Signify
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    // Bail if WooCommerce is not installed
    return;
}

$enable_content = get_theme_mod( 'signify_woo_products_showcase_option', 'disabled' );

if ( ! signify_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$number          = get_theme_mod( 'signify_woo_products_showcase_number', 8 );
$columns         = 3;

$shortcode = '[products';

if ( $number ) {
	$shortcode .= ' limit="' . esc_attr( $number ) . '"';
}

if ( $columns ) {
	$shortcode .= ' columns="' . absint( $columns ) . '"';
}

$shortcode .= ']';

$signify_title     = get_theme_mod( 'signify_woo_products_showcase_headline', esc_html__( 'Exclusive Merch', 'signify-ecommerce' ) );
$sub_title = get_theme_mod( 'signify_woo_products_showcase_subheadline');

$classes[] = 'section';

if ( ! $signify_title && ! $sub_title ) {
	$classes[] = 'no-section-heading';
}

$background = get_theme_mod( 'signify_woo_products_showcase_bg_image' );

if ( $background ) {
	$classes[] = 'has-background-image';
}
?>

<div id="product-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $signify_title || $sub_title ) : ?>
			<div class="section-heading-wrapper woo-products-showcase-section-headline">
				<?php if ( $sub_title ) : ?>
					<div class="section-subtitle">
						<?php
							echo esc_html( $sub_title );
						?>
					</div><!-- .section-description-wrapper -->
				<?php endif; ?>
				<?php if ( '' != $signify_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $signify_title ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper product-content-wrapper">
			<?php echo do_shortcode( $shortcode ); ?>
		</div><!-- .section-content-wrapper -->

		<?php
			$target = get_theme_mod( 'signify_woo_products_showcase_target' ) ? '_blank': '_self';
			$signify_link   = get_theme_mod( 'signify_woo_products_showcase_link', get_permalink( wc_get_page_id( 'shop' ) ) );
			$text   = get_theme_mod( 'signify_woo_products_showcase_text', esc_html__( 'Go to Shop Page', 'signify-ecommerce' ) );

			if ( $text ) :
		?>
			<p class="view-more">
				<a class="button" target="<?php echo $target; ?>" href="<?php echo esc_url( $signify_link ); ?>"><?php echo esc_html( $text ); ?></a>
			</p>
		<?php endif; ?>
	</div><!-- .wrapper -->
</div><!-- .sectionr -->
