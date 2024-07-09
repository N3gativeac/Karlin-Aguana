<?php
if ( 'simple' === $product_type ) {
	$checkbox_class = 'jtpt-check-checkbox jtpt-check-checkbox-' . esc_attr( $product_id );
} elseif ( 'variable' === $product_type ) {
	$checkbox_class = 'jtpt-check-checkbox jtpt-check-checkbox-' . esc_attr( $product_id ) . ' jtpt-variation-selection-needed';
} else {
	$checkbox_class = 'jtpt-check-checkbox jtpt-check-checkbox-' . esc_attr( $product_id ) . ' disabled';
}

$checkbox = '<label><input type="checkbox" class="' . esc_attr( $checkbox_class ) . '" data-jtpt-product-id="' . esc_attr( $product_id ) . '" data-jtpt-product-type="' . esc_attr( $product_type ) . '" data-jtpt-quantity="' . esc_attr( $product_min_purchase_quantity ) . '" data-jtpt-variation-id="" data-jtpt-variation=""><span></span></label>';
$column_element = '<div class="jtpt-check jtpt-check-' . esc_attr( $product_id ) . '">' . $checkbox . '</div>';