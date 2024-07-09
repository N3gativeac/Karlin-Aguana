<?php
$price_html = $product->get_price_html();
$column_element = '<div class="jtpt-price jtpt-price-' . esc_attr( $product_id ) . '" data-jtpt-simple-price="' . esc_attr( $price_html ) . '">' . $price_html . '</div>';