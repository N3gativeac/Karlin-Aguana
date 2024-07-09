<?php
$description = $product->get_description();
$column_element = '<div class="jtpt-description jtpt-description-' . esc_attr( $product_id ) . '" data-jtpt-simple-description="' . esc_attr( wp_kses_post( $description ) ) . '">' . wp_kses_post( $description ) . '</div>';