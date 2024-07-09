<?php
$created_date = get_the_date();
$unix_created_date = get_the_date( 'U' );
$column_element = '<div class="jtpt-created-date jtpt-created-date-' . esc_attr( $product_id ) . '" data-sort="' . esc_attr( $unix_created_date ) . '">' . $created_date . '</div>';