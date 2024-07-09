<?php
$dimensions = wc_format_dimensions( $product->get_dimensions( false ) );

if ( 'N/A' === $dimensions ) {
	$dimensions = '';
}

$column_element = '<div class="jtpt-dimensions jtpt-dimensions-' . esc_attr( $product_id ) . '" data-jtpt-simple-dimensions-html="' . esc_attr( $dimensions ) . '">' . $dimensions . '</div>';