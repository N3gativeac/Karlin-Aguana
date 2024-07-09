<?php
if ( function_exists( 'WishSuite' ) ) {
	$wishlist = do_shortcode( '[wishsuite_button product_id="' . $product_id . '" button_text="" button_added_text="" button_exist_text=""]' );
} elseif ( function_exists( 'YITH_WCWL' ) ) {
	$wishlist = do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . $product_id . '" label="" browse_wishlist_text="" already_in_wishslist_text="" product_added_text=""]' );
} else {
	$wishlist = '';
}

$column_element = '<div class="jtpt-wishlist jtpt-wishlist-' . esc_attr( $product_id ) . '">' . $wishlist . '</div>';