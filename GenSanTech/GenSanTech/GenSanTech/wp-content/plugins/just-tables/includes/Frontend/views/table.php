<?php
/**
 * JustTables Markup.
 *
 * Current Product Table markup.
 * Markup generate based on current Product Table options.
 *
 * @since 1.0.0
 */

// Active columns.
$active_columns = isset( $active_columns ) ? (array) $active_columns : array();
$active_columns_id = isset( $active_columns_id ) ? (array) $active_columns_id : array();

// Element configuration.
$element_configuration = array(
	'title_on_click'                    => $title_on_click,
	'thumbnail_size'                    => $thumbnail_size,
	'thumbnail_on_click'                => $thumbnail_on_click,
	'view_product_button_text'          => $view_product_button_text,
	'view_product_target'               => $view_product_target,
	'in_stock_status_text'              => $in_stock_status_text,
	'out_of_stock_status_text'          => $out_of_stock_status_text,
	'select_variation_text'             => $select_variation_text,
	'select_variation_all_options_text' => $select_variation_all_options_text,
	'variation_not_available_text'      => $variation_not_available_text,
);

// WooCommerce settings.
$woocommerce_settings = array(
	'currency_symbol'    => get_woocommerce_currency_symbol(),
	'currency_position'  => get_option( 'woocommerce_currency_pos' ),
	'decimal_separator'  => wc_get_price_decimal_separator(),
	'thousand_separator' => wc_get_price_thousand_separator(),
	'number_of_decimal'  => wc_get_price_decimals(),
	'weight_unit'        => get_option( 'woocommerce_weight_unit' ),
	'dimension_unit'     => get_option( 'woocommerce_dimension_unit' ),
);

// DataTable configuration.
$data_table_configuration = array(
	'products_per_page'       => $products_per_page,
	'products_not_found_text' => $products_not_found_text,
	'paginate_info'           => $paginate_info,
	'paginate_info_text'      => $paginate_info_text,
	'export_buttons'          => array(),
);

// Table head row.
$table_head_row = '';

// Table body rows.
$table_body_rows = '';

// Table head data.
$table_head_data = '';

// Head columns count.
$head_columns_count = (int) 1;

// Loop through active columns.
foreach ( $active_columns as $key => $value ) {
	$table_head_column_heading = isset( $value['heading'] ) ? sanitize_text_field( $value['heading'] ) : '';
	$table_head_column_sort = isset( $value['sort'] ) ? sanitize_key( $value['sort'] ) : '';
	$table_head_column_priority = isset( $value['priority'] ) ? (float) $value['priority'] : 1000;

	// Table head data class.
	$table_head_data_class = 'jtpt-head-data jtpt-head-data-' . $head_columns_count . ' jtpt-no-sort';

	// Update table head data.
	$table_head_data .= '<th class="' . esc_attr( $table_head_data_class ) . '" data-priority="' . esc_attr( $table_head_column_priority ) . '">' . esc_html( $table_head_column_heading ) . '</th>';

	// Head columns count increment.
	$head_columns_count++;
}

// Update table head row.
$table_head_row = '<tr class="jtpt-head-row">' . $table_head_data . '</tr>';

// Query arguments.
$query_args = array(
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
);

// Order.
$query_args['order'] = $order;

// Taxonomy query includes.
$taxonomy_query_includes = array();

// Taxonomy query includes.
if ( ! empty( $taxonomy_include ) ) {
	foreach ( $taxonomy_include as $key => $value ) {
		$keyword = isset( $value['keyword'] ) ? sanitize_key( $value['keyword'] ) : '';
		$term_ids = isset( $value['term-ids'] ) ? sanitize_text_field( $value['term-ids'] ) : '';
		$term_ids = just_tables_string_explode_and_sanitize_array_of_id( $term_ids );
		$children = isset( $value['children'] ) ? rest_sanitize_boolean( $value['children'] ) : true;

		// Update taxonomy query includes.
		if ( ! empty( $keyword ) && ! empty( $term_ids ) ) {
			$taxonomy_query_includes[ $keyword ] = just_tables_taxonomy_query_include( $keyword, $term_ids, $children );
		}
	}
}

// Taxonomy query excludes.
$taxonomy_query_excludes = array();

// Update taxonomy query arguments.
$taxonomy_query_includes_args = array_values( $taxonomy_query_includes );
$taxonomy_query_excludes_args = array_values( $taxonomy_query_excludes );
$taxonomy_query_args = array_merge( $taxonomy_query_includes_args, $taxonomy_query_excludes_args );

// Update query arguments.
$query_args['tax_query'] = $taxonomy_query_args;

// Taxonomy filter selects.
$taxonomy_filter_selects = '';

// Table wrapper class.
$table_wrapper_class = 'jtpt-product-table-wrapper jtpt-product-table-' . $table_id . '-wrapper';

if ( ! empty( $table_wrapper_extra_class_name ) ) {
	$table_wrapper_class .= ' ' . $table_wrapper_extra_class_name;
}

$table_wrapper_class .= ' jtpt-default-font-family';

// Table class.
$table_class = 'jtpt-product-table jtpt-product-table-' . $table_id;
if ( ! empty( $table_extra_class_name ) ) {
	$table_class .= ' ' . $table_extra_class_name;
}

// Table html.
$table_html = '';

$table_html .= '<!-- jtpt-product-table-' . esc_html( $table_id ) . ' start -->';
$table_html .= '<div class="' . esc_attr( $table_wrapper_class ) . '" data-jtpt-product-table-id="' . esc_html( $table_id ) . '" data-jtpt-query-args-json="' . esc_attr( wp_json_encode( $query_args ) ) . '" data-jtpt-taxonomy-query-include-args-json="' . esc_attr( wp_json_encode( $taxonomy_query_includes ) ) . '" data-jtpt-taxonomy-query-filter-include-args-json="' . esc_attr( wp_json_encode( $taxonomy_query_includes ) ) . '" data-jtpt-taxonomy-query-exclude-args-json="' . esc_attr( wp_json_encode( $taxonomy_query_excludes ) ) . '" data-jtpt-taxonomy-query-filter-exclude-args-json="' . esc_attr( wp_json_encode( $taxonomy_query_excludes ) ) . '" data-jtpt-columns-json="' . esc_attr( wp_json_encode( $active_columns ) ) . '" data-jtpt-columns-id-json="' . esc_attr( wp_json_encode( $active_columns_id ) ) . '" data-jtpt-element-configuration-json="' . esc_attr( wp_json_encode( $element_configuration ) ) . '" data-jtpt-data-table-configuration-json="' . esc_attr( wp_json_encode( $data_table_configuration ) ) . '" data-jtpt-woocommerce-settings-json="' . esc_attr( wp_json_encode( $woocommerce_settings ) ) . '">';

if ( true === $search_box ) {
	$table_html .= '<div class="jtpt-filter">';
	$table_html .= '<div class="jtpt-filter-header">';
	$table_html .= '<div class="jtpt-filter-header-right">';

	if ( true === $search_box ) {
		$table_html .= '<div class="jtpt-search">';
		$table_html .= '<input type="text" class="jtpt-search-input" name="jtpt-search-input" placeholder="' . esc_attr( $search_box_placeholder_text ) . '"><span><i class="flaticon-loupe"></i></span>';
		$table_html .= '</div>';
	}

	$table_html .= '</div>';
	$table_html .= '</div>';
	$table_html .= '</div>';
}

$table_html .= '<table class="' . esc_attr( $table_class ) . '">';

if ( true === $table_header ) {
	$table_html .= '<thead class="jtpt-head">' . $table_head_row . '</thead>';
} else {
	$table_html .= '<thead class="jtpt-head jtpt-head-hidden">' . $table_head_row . '</thead>';
}

$table_html .= '<tbody class="jtpt-body">' . just_tables_generate_table_body_rows( $query_args, $active_columns, $active_columns_id, $element_configuration, $woocommerce_settings ) . '</tbody>';
$table_html .= '</table>';
$table_html .= '<div class="jtpt-paginate"><div class="jtpt-paginate-info"></div><div class="jtpt-paginate-numbers"></div></div>';
$table_html .= '<div class="jtpt-export"><div class="jtpt-export-buttons"></div></div>';
$table_html .= '<div id="jtpt-notices-popup"><div class="jtpt-notices"></div></div>';
$table_html .= '<div class="jtpt-overlay"><img src="' . JUST_TABLES_ASSETS . '/images/preloader.svg" alt="Preloader"></div>';
$table_html .= '</div>';
$table_html .= '<!-- jtpt-product-table-' . esc_html( $table_id ) . ' end -->';