<?php
$attributes = $product->get_attributes();
$attributes_html = just_tables_product_attributes_formatting( $product_id, $attributes );

$column_element = '<div class="jtpt-attributes jtpt-attributes-' . esc_attr( $product_id ) . '">' . $attributes_html . '</div>';