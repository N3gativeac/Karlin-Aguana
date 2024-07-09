<?php

ob_start();
the_widget(
	'WC_Widget_Cart',
	array(
		'title'         => '',
		'hide_if_empty' => false,
	)
);
$widget = ob_get_clean();

$heading = esc_html__( 'Your Shopping Cart', 'onestore' );
onestore_popup( 'off-canvas-cart', $heading, $widget, 'right' );
