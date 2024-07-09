<?php
$height = $product->get_height();

if ( ! empty( $height ) && ! empty( $dimension_unit ) ) {
	$height = $height . ' ' . $dimension_unit;
}

$column_element = '<div class="jtpt-height jtpt-height-' . esc_attr( $product_id ) . '" data-jtpt-simple-height="' . esc_attr( $height ) . '">' . $height . '</div>';