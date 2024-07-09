<?php
$categories = just_tables_product_taxonomy_terms_list( $product_id, 'product_cat' );
$column_element = '<div class="jtpt-categories jtpt-categories-' . esc_attr( $product_id ) . '">' . wp_kses_data( $categories ) . '</div>';