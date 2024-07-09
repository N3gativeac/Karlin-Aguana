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
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$cart = WC()->cart;

if ( empty( $cart ) ) {
	return;
}

$count = $cart->get_cart_contents_count();

OneStore::instance()->add_hidden_canvas( 'cart-content', 'canvas-cart' );
?>
<div class="<?php echo esc_attr( 'header-' . $slug ); ?> header-shopping-cart menu action-toggle-menu">
	<div class="menu-item">
		<button data-target="off-canvas-cart" class="shopping-cart-link popup-toggle action-toggle" aria-expanded="false">
			<?php onestore_icon( 'shopping-bag', array( 'class' => 'onestore-menu-icon' ) ); ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Shopping Cart', 'onestore' ); ?></span>
			<span class="shopping-cart-count" data-count="<?php echo esc_attr( $count ); ?>"><?php echo $count; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</button>
	</div>
</div>

