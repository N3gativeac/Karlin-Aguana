<?php
$weight = $product->get_weight();

if ( ! empty( $weight ) && ! empty( $weight_unit ) ) {
	$weight = $weight . ' ' . $weight_unit;
}

$column_element = '<div class="jtpt-weight jtpt-weight-' . esc_attr( $product_id ) . '" data-jtpt-simple-weight-html="' . esc_attr( $weight ) . '">' . $weight . '</div>';