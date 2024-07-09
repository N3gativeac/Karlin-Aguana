<?php
/**
 * Header search dropdown template.
 *
 * Passed variables:
 *
 * @type string $slug Header element slug.
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$cart = WC()->cart;

if ( empty( $cart ) ) {
	return;
}

$count = $cart->get_cart_contents_count();
?>
<div class="<?php echo esc_attr( 'header-' . $slug ); ?> header-shopping-cart menu">
	<div class="menu-item">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="shopping-cart-link">
			<?php onestore_icon( 'shopping-bag', array( 'class' => 'onestore-menu-icon' ) ); ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Shopping Cart', 'onestore' ); ?></span>
			<span class="shopping-cart-count" data-count="<?php echo esc_attr( $count ); ?>"><?php echo $count; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</a>
	</div>
</div>