<?php
if ( function_exists( 'YITH_WCQV' ) ) {
	$quick_view = do_shortcode( '[yith_quick_view product_id="' . $product_id . '"]' );
} else {
	$quick_view = '';
}

$column_element = '<div class="jtpt-quick-view jtpt-quick-view-' . esc_attr( $product_id ) . '">' . $quick_view . '</div>';