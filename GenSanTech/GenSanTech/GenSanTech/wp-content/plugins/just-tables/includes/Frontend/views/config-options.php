<?php
/**
 * JustTables Config Options.
 *
 * Current Product Table Config options values and default.
 * Options values generate based on user input while current Product Table created and updated.
 *
 * @since 1.0.0
 */

// Taxonomy include.
if ( isset( $product_table_options['taxonomy-include'] ) && ! empty( $product_table_options['taxonomy-include'] ) ) {
	$taxonomy_include = (array) $product_table_options['taxonomy-include'];
} else {
	$taxonomy_include = array();
}

// Order.
if ( isset( $product_table_options['order'] ) && ! empty( trim( $product_table_options['order'] ) ) ) {
	$order = sanitize_key( $product_table_options['order'] );
	$order = strtoupper( $order );
} else {
	$order = 'DESC';
}

// Products per page.
if ( isset( $product_table_options['products-per-page'] ) && ( '' !== trim( $product_table_options['products-per-page'] ) ) ) {
	$products_per_page = just_tables_sanitize_products_per_page_value( $product_table_options['products-per-page'] );
} else {
	$products_per_page = 10;
}

// Table header.
if ( isset( $product_table_options['table-header'] ) ) {
	$table_header = rest_sanitize_boolean( $product_table_options['table-header'] );
} else {
	$table_header = true;
}

// Title on click.
$title_on_click = 'view';

// Thumbnail size.
$thumbnail_size = 'thumbnail';

// Thumbnail on click.
$thumbnail_on_click = 'view';

// View product button text.
if ( isset( $product_table_options['view-product-button-text'] ) && ! empty( trim( $product_table_options['view-product-button-text'] ) ) ) {
	$view_product_button_text = sanitize_text_field( $product_table_options['view-product-button-text'] );
} else {
	$view_product_button_text = 'View Product';
}

// View product target.
$view_product_target = 'self';

// Search box.
if ( isset( $product_table_options['search-box'] ) ) {
	$search_box = rest_sanitize_boolean( $product_table_options['search-box'] );
} else {
	$search_box = true;
}

// Search box placeholder text.
if ( isset( $product_table_options['search-box-placeholder-text'] ) && ! empty( $product_table_options['search-box-placeholder-text'] ) ) {
	$search_box_placeholder_text = sanitize_text_field( $product_table_options['search-box-placeholder-text'] );
} else {
	$search_box_placeholder_text = esc_html__( 'Search...', 'just-tables' );
}

// In stock status text.
if ( isset( $product_table_options['in-stock-status-text'] ) && ! empty( trim( $product_table_options['in-stock-status-text'] ) ) ) {
	$in_stock_status_text = sanitize_text_field( $product_table_options['in-stock-status-text'] );
} else {
	$in_stock_status_text = esc_html__( 'In stock', 'just-tables' );
}

// Out of stock status text.
if ( isset( $product_table_options['out-of-stock-status-text'] ) && ! empty( trim( $product_table_options['out-of-stock-status-text'] ) ) ) {
	$out_of_stock_status_text = sanitize_text_field( $product_table_options['out-of-stock-status-text'] );
} else {
	$out_of_stock_status_text = esc_html__( 'Out of stock', 'just-tables' );
}

// Select variation text.
if ( isset( $product_table_options['select-variation-text'] ) && ! empty( trim( $product_table_options['select-variation-text'] ) ) ) {
	$select_variation_text = sanitize_text_field( $product_table_options['select-variation-text'] );
} else {
	$select_variation_text = esc_html__( 'Please select a variation!', 'just-tables' );
}

// Select variation all options text.
if ( isset( $product_table_options['select-variation-all-options-text'] ) && ! empty( trim( $product_table_options['select-variation-all-options-text'] ) ) ) {
	$select_variation_all_options_text = sanitize_text_field( $product_table_options['select-variation-all-options-text'] );
} else {
	$select_variation_all_options_text = esc_html__( 'Please select all options!', 'just-tables' );
}

// Variation not available text.
if ( isset( $product_table_options['variation-not-available-text'] ) && ! empty( trim( $product_table_options['variation-not-available-text'] ) ) ) {
	$variation_not_available_text = sanitize_text_field( $product_table_options['variation-not-available-text'] );
} else {
	$variation_not_available_text = esc_html__( 'Not available!', 'just-tables' );
}

// Products not found text.
if ( isset( $product_table_options['products-not-found-text'] ) && ! empty( trim( $product_table_options['products-not-found-text'] ) ) ) {
	$products_not_found_text = sanitize_text_field( $product_table_options['products-not-found-text'] );
} else {
	$products_not_found_text = esc_html__( 'Nothing found - sorry!', 'just-tables' );
}

// Paginate info.
$paginate_info = true;

// Paginate info text.
if ( isset( $product_table_options['paginate-info-text'] ) && ! empty( trim( $product_table_options['paginate-info-text'] ) ) ) {
	$paginate_info_text = sanitize_text_field( $product_table_options['paginate-info-text'] );
} else {
	$paginate_info_text = sprintf( esc_html__( 'Showing %1$s to %2$s of %3$s entries', 'just-tables' ), '_START_', '_END_', '_TOTAL_' );
}

// Table extra class name.
if ( isset( $product_table_options['table-extra-class-name'] ) && ! empty( $product_table_options['table-extra-class-name'] ) ) {
	$table_extra_class_name = just_tables_string_explode_and_sanitize_multiple_class( $product_table_options['table-extra-class-name'] );
} else {
	$table_extra_class_name = '';
}

// Table wrapper extra class name.
if ( isset( $product_table_options['wrapper-extra-class-name'] ) && ! empty( $product_table_options['wrapper-extra-class-name'] ) ) {
	$table_wrapper_extra_class_name = just_tables_string_explode_and_sanitize_multiple_class( $product_table_options['wrapper-extra-class-name'] );
} else {
	$table_wrapper_extra_class_name = '';
}