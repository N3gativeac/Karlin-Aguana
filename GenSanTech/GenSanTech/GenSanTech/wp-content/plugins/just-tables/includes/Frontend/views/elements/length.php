<?php
$length = $product->get_length();

if ( ! empty( $length ) && ! empty( $dimension_unit ) ) {
	$length = $length . ' ' . $dimension_unit;
}

$column_element = '<div class="jtpt-length jtpt-length-' . esc_attr( $product_id ) . '" data-jtpt-simple-length="' . esc_attr( $length ) . '">' . $length . '</div>';