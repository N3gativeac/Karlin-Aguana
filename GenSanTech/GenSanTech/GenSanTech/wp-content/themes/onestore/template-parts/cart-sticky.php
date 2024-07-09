<?php
$position = onestore_get_theme_mod( 'woocommerce_single_sticky_cart', 'top' );
the_post();
global $product;
if ( defined( 'SAVP__PATH' ) ) {
	savp()->frontend()->in_sidebar = true;
}
?>
<section id="cart-sticky" class="cart-sticky section-inner pos-<?php echo esc_attr( $position ); ?>">
	<div class="wrapper">
		<div class="sticky-cart-inner">
			<div class="thumbnail">
				<?php echo woocommerce_get_product_thumbnail(); ?>
				<h2 class="cart-sticky-title text-upper"><?php echo get_the_title(); ?></h2>
			</div>
			<span class="cart-sticky-price price"><?php echo $product->get_price_html(); ?></span>
			<button class="cart-sticky-btn"><?php echo $product->add_to_cart_text(); ?></button>
		</div>
	</div>
</section>

<?php rewind_posts(); ?>
