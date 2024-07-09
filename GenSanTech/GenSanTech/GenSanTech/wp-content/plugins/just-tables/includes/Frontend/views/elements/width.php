<?php
$width = $product->get_width();

if ( ! empty( $width ) && ! empty( $dimension_unit ) ) {
	$width = $width . ' ' . $dimension_unit;
}

$column_element = '<div class="jtpt-width jtpt-width-' . esc_attr( $product_id ) . '" data-jtpt-simple-width="' . esc_attr( $width ) . '">' . $width . '</div>';