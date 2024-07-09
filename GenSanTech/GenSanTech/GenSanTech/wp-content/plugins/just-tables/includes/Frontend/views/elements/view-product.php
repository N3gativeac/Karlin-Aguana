<?php
if ( 'blank' === $view_product_target ) {
	$view_product_button = '<a target="_blank" href="' . esc_attr( $product_permalink ) . '" class="button jtpt-view-product-button">' . wp_kses_data( $view_product_button_text ) . '</a>';
} else {
	$view_product_button = '<a href="' . esc_attr( $product_permalink ) . '" class="button jtpt-view-product-button">' . wp_kses_data( $view_product_button_text ) . '</a>';
}

$column_element = '<div class="jtpt-view-product jtpt-view-product-' . esc_attr( $product_id ) . '">' . $view_product_button . '</div>';