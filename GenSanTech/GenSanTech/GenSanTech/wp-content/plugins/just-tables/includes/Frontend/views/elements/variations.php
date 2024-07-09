<?php
$variations_html = '';

if ( 'variable' === $product_type ) {
	$variation_attributes = $product->get_variation_attributes();
	$default_attributes = $product->get_default_attributes();
	$available_variations = $product->get_available_variations();

	$variations_html = '<div class="jtpt-variations-options jtpt-variations-options-' . esc_attr( $product_id ) . '" data-jtpt-product-id="' . esc_attr( $product_id ) . '" data-jtpt-available-variations-json="' . htmlspecialchars( wp_json_encode( $available_variations ) ) . '" data-jtpt-default-attributes-json="' . htmlspecialchars( wp_json_encode( $default_attributes ) ) . '">' . just_tables_variations_filter_select( $product_id, $variation_attributes, $default_attributes ) . '<div class="jtpt-variations-notice jtpt-variations-notice-' . esc_attr( $product_id ) . '">' . esc_html__( 'Please select a variation!', 'just-tables' ) . '</div></div>';
}

$column_element = '<div class="jtpt-variations jtpt-variations-' . esc_attr( $product_id ) . '">' . $variations_html . '</div>';