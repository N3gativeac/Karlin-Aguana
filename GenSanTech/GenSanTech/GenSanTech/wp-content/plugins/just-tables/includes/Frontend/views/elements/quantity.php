<?php
$quantity_label = sprintf(
	/* translators: %s: Product title */
	esc_html__( '%s quantity', 'just-tables' ),
	$product_title
);

$quantity_args = array(
	'min_value'   => $product_min_purchase_quantity,
	'max_value'   => $product_max_purchase_quantity,
	'input_value' => $product_min_purchase_quantity,
);

// Update product max purchase quantity based on stock status.
$stock_status = $product->get_stock_status();
if ( 'outofstock' === $stock_status ) {
	$product_max_purchase_quantity = 0;
} elseif( -1 === $product_max_purchase_quantity ) {
	$product_max_purchase_quantity = '';
}

if ( $product->is_sold_individually() || 1 === $product_max_purchase_quantity ) {
	$quantity_input = '<div class="quantity"><label class="screen-reader-text">' . esc_html( $quantity_label ) . '</label><input type="number" class="input-text qty text" step="1" min="1" max="1" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric" disabled></div>';
} else {
	$quantity_input = woocommerce_quantity_input( $quantity_args, $product, false );
}

$column_element = '<div class="jtpt-quantity jtpt-quantity-' . esc_attr( $product_id ) . ' jtpt-quantity-plus-minus" data-jtpt-product-id="' . esc_attr( $product_id ) . '">' . $quantity_input . '</div>';