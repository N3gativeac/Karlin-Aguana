<?php
// Column element html
$column_element_html = '';

// Title.
if ( ! empty( $product_title ) && 'view' === $title_on_click ) {
	if ( 'blank' === $view_product_target ) {
		$title_html = '<a target="_blank" href="' . esc_url( $product_permalink ) . '">' . wp_kses_data( $product_title ) . '</a>';
	} else {
		$title_html = '<a href="' . esc_url( $product_permalink ) . '">' . wp_kses_data( $product_title ) . '</a>';
	}
} else {
	$title_html = wp_kses_data( $product_title );
}

// Update column element html.
if ( ! empty( $title_html ) ) {
	$column_element_html .= '<div class="jtpt-title jtpt-title-' . esc_attr( $product_id ) . '">' . $title_html . '</div>';
}

// Rating.
if ( in_array( 'rating', $title_add_elements ) && ! in_array( 'rating', $active_columns_id ) ) {
	$average_rating = $product->get_average_rating();
	if ( '0' === $average_rating ) {
		$rating_text = esc_html__( 'Not yet rated', 'just-tables' );
	} else {
		$rating_text = sprintf(
			/* translators: %s: Average rating value */
			esc_html__( '%s out of 5', 'just-tables' ),
			$average_rating
		);
	}
	$rating_percentage = ( $average_rating / 5 ) * 100;

	$rating_html = '<div class="star-rating" title="' . esc_attr( $rating_text ) . '"><span style="width: ' . esc_attr( $rating_percentage ) . '%"></span></div>';
	$rating_html .= '<div class="text-rating" title="' . esc_attr( $rating_text ) . '">(' . esc_html( $average_rating ) . ')</div>';
} else {
	$rating_html = '';
}

// Short description.
if ( in_array( 'short-description', $title_add_elements ) && ! in_array( 'short-description', $active_columns_id ) ) {
	$short_description = $product->get_short_description();
	$short_description_html = wp_kses_post( $short_description );
} else {
	$short_description_html = '';
}

// Description.
if ( in_array( 'description', $title_add_elements ) && ! in_array( 'description', $active_columns_id ) ) {
	$description = $product->get_description();
	$description_html = wp_kses_post( $description );
} else {
	$description_html = '';
}

// Update column element html.
if ( is_array( $title_add_elements ) && ! empty( $title_add_elements ) ) {
	if ( ! empty( $rating_html ) ) {
		$column_element_html .= '<div class="jtpt-rating jtpt-rating-' . esc_attr( $product_id ) . '">' . $rating_html . '</div>';
	}

	if ( ! empty( $short_description_html ) ) {
		$column_element_html .= '<div class="jtpt-short-description jtpt-short-description-' . esc_attr( $product_id ) . '">' . $short_description_html . '</div>';
	}

	if ( ! empty( $description_html ) ) {
		$column_element_html .= '<div class="jtpt-description jtpt-description-' . esc_attr( $product_id ) . '" data-jtpt-simple-description="' . esc_attr( wp_kses_post( $description ) ) . '">' . $description_html . '</div>';
	}
}

$column_element = $column_element_html;