<?php
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

$column_element = '<div class="jtpt-rating jtpt-rating-' . esc_attr( $product_id ) . '">' . $rating_html . '</div>';