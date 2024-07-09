<?php
$custom_field_class = 'jtpt-custom-field';
$custom_field_content = '';

if ( ( 'field' === $custom_type ) && ! empty( $custom_keyword ) ) {
	$custom_field_class .= ' jtpt-cf-' . $custom_keyword;

    if ( function_exists( 'acf' ) && function_exists( 'get_field' ) ) {
		$acf_field_content = get_field( $custom_keyword );
		$custom_field_content = ! empty( trim( $acf_field_content ) ) ? $acf_field_content : '';
	}

	if ( empty( $custom_field_content ) ) {
		$custom_field_content = get_post_meta( $product_id, $custom_keyword, true );
	}

	if ( ! empty( $custom_field_content ) && is_string( $custom_field_content ) ) {
		$custom_field_content = wp_kses_post( $custom_field_content );
		$custom_field_content = do_shortcode( $custom_field_content );
	} else {
		$custom_field_content = '';
	}
}

$column_element = '<div class="' . esc_attr( $custom_field_class ) . '">';
$column_element .= $custom_field_content;
$column_element .= '</div>';