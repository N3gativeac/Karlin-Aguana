<?php
$tags = just_tables_product_taxonomy_terms_list( $product_id, 'product_tag' );
$column_element = '<div class="jtpt-tags jtpt-tags-' . esc_attr( $product_id ) . '">' . wp_kses_data( $tags ) . '</div>';