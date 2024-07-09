<?php
$availability = $product->get_availability();

$availability_text = isset( $availability['availability'] ) ? $availability['availability'] : '';
$availability_class = isset( $availability['class'] ) ? $availability['class'] : '';

if ( ! empty( $availability_text ) ) {
	$stock_status_text = $availability_text;
} elseif ( 'in-stock' === $availability_class ) {
	$stock_status_text = $in_stock_status_text;
} else {
	$stock_status_text = $out_of_stock_status_text;
}

$stock_html = '<p class="stock ' . esc_attr( $availability_class ) . '">' . $stock_status_text . '</p>';

$column_element = '<div class="jtpt-stock jtpt-stock-' . esc_attr( $product_id ) . '" data-jtpt-simple-stock-html="' . esc_attr( $stock_html )  . '">' . $stock_html . '</div>';