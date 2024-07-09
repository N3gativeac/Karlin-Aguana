<?php
// Action column elements.
$action_column_elements = array( 'wishlist', 'add-to-cart', 'variations' );

// Column element html
$column_element_html = '';

// Add to cart button.
if ( 'grouped' === $product_type ) {
	$atc_button_url = $product_permalink;
	$atc_button_class = 'jtpt-add-to-cart';
} elseif ( 'external' === $product_type ) {
	$atc_button_url = $product->add_to_cart_url();
	$atc_button_class = 'jtpt-add-to-cart';
} elseif ( 'variable' === $product_type ) {
	$atc_button_url = $product_permalink;
	$atc_button_class = 'jtpt-add-to-cart jtpt-variation-selection-needed';
} else {
	$atc_button_url = $product_permalink;
	$atc_button_class = 'jtpt-add-to-cart jtpt-ajax-add-to-cart';
}

if ( 'blank' === $view_product_target ) {
	$atc_button = '<a class="' . esc_attr( $atc_button_class ) . '" target="_blank" href="' . esc_attr( $atc_button_url ) . '" data-jtpt-product-id="' . esc_attr( $product_id ) . '" data-jtpt-product-type="' . esc_attr( $product_type ) . '" data-jtpt-quantity="' . esc_attr( $product_min_purchase_quantity ) . '" data-jtpt-variation-id="" data-jtpt-variation=""><i class="flaticon-shopping-cart"></i></a>';
} else {
	$atc_button = '<a class="' . esc_attr( $atc_button_class ) . '" href="' . esc_attr( $atc_button_url ) . '" data-jtpt-product-id="' . esc_attr( $product_id ) . '" data-jtpt-product-type="' . esc_attr( $product_type ) . '" data-jtpt-quantity="' . esc_attr( $product_min_purchase_quantity ) . '" data-jtpt-variation-id="" data-jtpt-variation=""><i class="flaticon-shopping-cart"></i></a>';
}

// Wishlist button.
if ( in_array( 'wishlist', (array) $action_add_elements ) && ! in_array( 'wishlist', (array) $active_columns_id ) ) {
	if ( function_exists( 'WishSuite' ) ) {
		$wishlist_button = do_shortcode( '[wishsuite_button product_id="' . $product_id . '" button_text="" button_added_text="" button_exist_text=""]' );
	} elseif ( function_exists( 'YITH_WCWL' ) ) {
		$wishlist_button = do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . $product_id . '" label="" browse_wishlist_text="" already_in_wishslist_text="" product_added_text=""]' );
	} else {
		$wishlist_button = '';
	}
} else {
	$wishlist_button = '';
}

// Variations button.
if ( ! in_array( 'variations', (array) $active_columns_id ) && ( 'variable' === $product_type ) ) {
	$variation_attributes = $product->get_variation_attributes();
	$default_attributes = $product->get_default_attributes();
	$available_variations = $product->get_available_variations();

	$variations_select = just_tables_variations_filter_select( $product_id, $variation_attributes, $default_attributes );

	$variations_button = '<a class="jtpt-variations" href="#"><i class="flaticon-levels"></i></a>';
	$variations_button .= '<div class="jtpt-variations-options jtpt-variations-options-' . esc_attr( $product_id ) . '" data-jtpt-product-id="' . esc_attr( $product_id ) . '" data-jtpt-available-variations-json="' . htmlspecialchars( wp_json_encode( $available_variations ) ) . '" data-jtpt-default-attributes-json="' . htmlspecialchars( wp_json_encode( $default_attributes ) ) . '">' . $variations_select . '<div class="jtpt-variations-notice jtpt-variations-notice-' . esc_attr( $product_id ) . '">' . esc_html__( 'Please select a variation!', 'just-tables' ) . '</div></div>';
} else {
	$variations_button = '';
}

// Update column element html.
if ( is_array( $action_column_elements ) && ! empty( $action_column_elements ) ) {
	$column_element_html .= '<ul class="jtpt-action-list">';

	if ( ! empty( $wishlist_button ) ) {
		$column_element_html .= '<li class="jtpt-action-item jtpt-wishlist-button jtpt-wishlist-button-' . esc_attr( $product_id ) . '">' . $wishlist_button . '</li>';
	}

	if ( ! empty( $atc_button ) ) {
		$column_element_html .= '<li class="jtpt-action-item jtpt-atc-button jtpt-atc-button-' . esc_attr( $product_id ) . '">' . $atc_button . '</li>';
	}

	if ( ! empty( $variations_button ) ) {
		$column_element_html .= '<li class="jtpt-action-item jtpt-variations-button jtpt-variations-button-' . esc_attr( $product_id ) . '">' . $variations_button . '</li>';
	}

	$column_element_html .= '</ul>';
}

$column_element = '<div class="jtpt-action jtpt-action-' . esc_attr( $product_id ) . '">' . $column_element_html . '</div>';