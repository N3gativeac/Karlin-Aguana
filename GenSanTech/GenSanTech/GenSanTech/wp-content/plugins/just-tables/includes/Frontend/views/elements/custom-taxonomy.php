<?php
$custom_taxonomy_class = 'jtpt-custom-taxonomy';
$custom_taxonomy_content = '';

if ( ( 'taxonomy' === $custom_type ) && ! empty( $custom_keyword ) ) {
	$custom_taxonomy_class .= ' jtpt-ct-' . $custom_keyword;
	if ( taxonomy_exists( $custom_keyword ) ) {
		$custom_taxonomy_terms = just_tables_product_taxonomy_terms_list( $product_id, $custom_keyword );

		if ( ! empty( $custom_taxonomy_terms ) && is_string( $custom_taxonomy_terms ) ) {
			$custom_taxonomy_content = just_tables_product_taxonomy_terms_list( $product_id, $custom_keyword );
		}
	}
}

$column_element = '<div class="' . esc_attr( $custom_taxonomy_class ) . '">';
$column_element .= $custom_taxonomy_content;
$column_element .= '</div>';