<?php
if ( function_exists( 'ever_compare' ) ) {
	$compare = do_shortcode( '[evercompare_button product_id="' . $product_id . '"]' );
} else {
	$compare = '';
}

$column_element = '<div class="jtpt-compare jtpt-compare-' . esc_attr( $product_id ) . '">' . $compare . '</div>';