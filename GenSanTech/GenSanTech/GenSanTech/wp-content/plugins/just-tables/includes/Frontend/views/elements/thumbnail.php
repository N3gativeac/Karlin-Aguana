<?php
$thumbnail_id = $product->get_image_id();
$thumbnail = $product->get_image( $thumbnail_size );
$thumbnail_url = wp_get_attachment_image_url( $thumbnail_id, 'full' );

if ( 'view' === $thumbnail_on_click ) {
	if ( 'blank' === $view_product_target ) {
		$thumbnail_html = '<a target="_blank" href="' . esc_url( $product_permalink ) . '">' . $thumbnail . '</a>';
	} else {
		$thumbnail_html = '<a href="' . esc_url( $product_permalink ) . '">' . $thumbnail . '</a>';
	}
} elseif ( 'popup' === $thumbnail_on_click ) {
	$thumbnail_html = '<a class="thickbox" href="' . esc_url( $thumbnail_url ) . '">' . $thumbnail . '</a>';
} else {
	$thumbnail_html = $thumbnail;
}

$column_element = '<div class="jtpt-thumbnail jtpt-thumbnail-' . esc_attr( $product_id ) . '" data-jtpt-simple-thumbnail-image-html="' . esc_attr( $thumbnail ) . '" data-jtpt-simple-thumbnail-image-url="' . esc_attr( $thumbnail_url ) . '">' . $thumbnail_html . '</div>';