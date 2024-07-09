<?php
/**
 * JustTables Functions.
 *
 * Necessary functions of the plugin.
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Product attributes formatting.
 *
 * @since 1.0.0
 *
 * @param int   $product_id Product ID.
 * @param array $attributes Product attributes. Default empty array.
 *
 * @return string|null
 */
function just_tables_product_attributes_formatting( $product_id, $attributes = array() ) {
    $attributes_html = '';

    $product_id = absint( $product_id );
    $attributes = (array) $attributes;

    if ( empty( $product_id ) || ! is_array( $attributes ) || empty( $attributes ) ) {
        return;
    }

    foreach ( $attributes as $key => $value ) {
        $attribute_name = $value->get_name();
        $attribute_label = wc_attribute_label( $attribute_name );

        $attribute_terms = array();

        if ( $value->is_taxonomy() ) {
            $taxonomy = $value->get_taxonomy_object();
            $taxonomy_terms = get_the_terms( $product_id, $attribute_name );

            foreach ( $taxonomy_terms as $key => $value ) {
                $term_name = $value->name;
                $attribute_terms[] = $term_name;
            }
        } else {
            $attribute_terms = $value->get_options();
        }

        if ( is_array( $attribute_terms ) ) {
            $attribute_terms = implode( ', ', $attribute_terms );
        }

        $attributes_html .= '<div class="attributes">';
        $attributes_html .= '<label>' . esc_html( $attribute_label ) . ':</label> ';
        $attributes_html .= '<span>' . wptexturize( $attribute_terms ) . '</span>';
        $attributes_html .= '</div>';
    }

    return $attributes_html;
}

/**
 * Variations filter select.
 *
 * @since 1.0.0
 *
 * @param int   $product_id Product ID.
 * @param array $variation_attributes Product variation attributes. Default empty array.
 * @param array $default_attributes Product default attributes. Default empty array.
 *
 * @return string|null
 */
function just_tables_variations_filter_select( $product_id, $variation_attributes = array(), $default_attributes = array() ) {
    $variations_select_html = '';

    $product_id = absint( $product_id );
    $variation_attributes = (array) $variation_attributes;
    $default_attributes = (array) $default_attributes;

    if ( empty( $product_id ) || ! is_array( $variation_attributes ) || empty( $variation_attributes ) || ! is_array( $default_attributes ) ) {
        return;
    }

    foreach ( $variation_attributes as $key => $value ) {
        $attribute_key = sanitize_title( $key );
        $attribute_label = wc_attribute_label( $attribute_key );
        $attribute_name = wc_variation_attribute_name( $attribute_key );
        $attribute_terms = (array) $value;

        if ( isset( $default_attributes[ $attribute_key ] ) ) {
            $attribute_default = $default_attributes[ $attribute_key ];
        } else {
            $attribute_default = '';
        }

        if( ! empty( $attribute_terms ) ) {
            $variations_select_html .= '<select class="jtpt-variation-filter-select jtpt-variation-filter-'. esc_attr( $attribute_name ) .'" data-jtpt-attribute="'. esc_attr( $attribute_name ) .'">';
            $variations_select_html .= '<option value="jtpt-select-label">'. esc_html( $attribute_label ) .'</option>';

            foreach ( $attribute_terms as $key => $value ) {
                if ( $attribute_default === $value ) {
                    $variations_select_html .= '<option value="' . esc_attr( $value ) . '" selected>' . esc_html( ucwords( $value ) ) . '</option>';
                } else {
                    $variations_select_html .= '<option value="' . esc_attr( $value ) . '">' . esc_html( ucwords( $value ) ) . '</option>';
                }
            }

            $variations_select_html .= '</select>';
        }
    }

    return $variations_select_html;
}

/**
 * Product taxonomy terms in a list.
 *
 * @since 1.0.0
 *
 * @param int    $product_id Product ID.
 * @param string $taxonomy Taxonomy key.
 * @param string $sep String to use between the terms. Default: ', '.
 * @param string $before String to use before the terms.
 * @param string $after String to use after the terms.
 *
 * @return string
 */
function just_tables_product_taxonomy_terms_list( $product_id, $taxonomy, $sep = ', ', $before = '', $after = '' ) {
    return get_the_term_list( $product_id, $taxonomy, $before, $sep, $after );
}

/**
 * Taxonomy terms filter select.
 *
 * @since 1.0.0
 *
 * @param string $keyword Taxonomy key.
 * @param array $include_term_ids Include taxonomy term IDs array. Default empty array.
 * @param array $exclude_term_ids Exclude taxonomy term IDs array. Default empty array.
 * @param boolean $hide_empty Hide empty taxonomy. Default true.
 *
 * @return string
 */
function just_tables_taxonomy_terms_filter_select( $keyword = '', $include_term_ids = array(), $exclude_term_ids = array(), $hide_empty = true ) {
    $terms_select = '';

    $keyword = sanitize_key( $keyword );
    $include_term_ids = (array) $include_term_ids;
    $exclude_term_ids = (array) $exclude_term_ids;

    if ( empty( trim( $keyword ) ) ) {
        return $terms_select;
    }

    $taxonomy_var = get_taxonomy( $keyword );

    $terms_args = array(
        'taxonomy'   => $keyword,
        'orderby'    => 'name',
        'hide_empty' => $hide_empty,
    );

    if ( ! empty( $include_term_ids ) ) {
        $terms_args['include'] = $include_term_ids;
    }

    if ( ! empty( $exclude_term_ids ) ) {
        $terms_args['exclude'] = $exclude_term_ids;
    }

    $terms = get_terms( $terms_args );

    if( is_array( $terms ) && ! empty( $terms ) ) {
        $terms_select .= '<select class="jtpt-filter-select jtpt-filter-'. esc_attr( $keyword ) .'" data-jtpt-taxonomy="'. esc_attr( $keyword ) .'" multiple="multiple" data-placeholder="' . esc_attr( esc_html( $taxonomy_var->labels->singular_name ) ) . '">';

        foreach ( $terms as $key => $value ) {
            $term_id = absint( $value->term_id );
            $name = $value->name;

            $terms_select .= '<option value="' . esc_attr( $term_id ) . '">' . esc_html( $name ) . '</option>';
        }

        $terms_select .= '</select>';
    }

    return $terms_select;
}

/**
 * Taxonomy query include.
 *
 * @since 1.0.0
 *
 * @param string $keyword Taxonomy keyword. Default empty string.
 * @param array $term_ids Taxonomy term IDs array. Default empty array.
 *
 * @return null|array
 */
function just_tables_taxonomy_query_include( $keyword = '', $term_ids = array(), $children = true ) {
    $args = array();

    $keyword = sanitize_key( $keyword );
    $term_ids = (array) $term_ids;

    if ( empty( $keyword ) || ! is_array( $term_ids ) || empty( $term_ids ) ) {
        return;
    }

    $args = array(
        'taxonomy'         => $keyword,
        'field'            => 'term_id',
        'terms'            => $term_ids,
        'include_children' => $children,
        'operator'         => 'IN',
    );

    return $args;
}

/**
 * Taxonomy query exclude.
 *
 * @since 1.0.0
 *
 * @param string $keyword Taxonomy keyword. Default empty string.
 * @param array $term_ids Taxonomy term IDs array. Default empty array.
 *
 * @return null|array
 */
function just_tables_taxonomy_query_exclude( $keyword = '', $term_ids = array(), $children = true ) {
    $args = array();

    $keyword = sanitize_key( $keyword );
    $term_ids = (array) $term_ids;

    if ( empty( $keyword ) || ! is_array( $term_ids ) || empty( $term_ids ) ) {
        return;
    }

    $args = array(
        'taxonomy'         => $keyword,
        'field'            => 'term_id',
        'terms'            => $term_ids,
        'include_children' => $children,
        'operator'         => 'NOT IN',
    );

    return $args;
}

/**
 * Stock availability query.
 *
 * @since 1.0.0
 *
 * @param array $availability Availability keys array. Default empty array.
 *
 * @return null|array
 */
function just_tables_stock_availability_query( $availability = array() ) {
    $args = array();

    if ( ! is_array( $availability ) || empty( $availability ) || 3 === count( $availability ) ) {
        return;
    }

    if ( 2 === count( $availability ) ) {
        $args['relation'] = 'OR';
    }

    foreach ( $availability as $key => $value ) {
        $args[] = array(
            'key'   => '_stock_status',
            'value' => $value,
        );
    }

    return $args;
}

/**
 * Sanitize array of ID.
 *
 * @since 1.0.0
 *
 * @param array $id Array of ID. Default empty array.
 *
 * @return array
 */
function just_tables_sanitize_array_of_id( $id = array() ) {
    $id_array = array();

    if ( is_array( $id ) && ! empty( $id ) ) {
        foreach ( $id as $item ) {
            $item = absint( $item );

            if ( 0 !== $item ) {
                $id_array[] = $item;
            }
        }
    }

    return $id_array;
}

/**
 * Sanitize array of key.
 *
 * @since 1.0.0
 *
 * @param array $key Array of key. Default empty array.
 *
 * @return array
 */
function just_tables_sanitize_array_of_key( $key = array() ) {
    $key_array = array();

    if ( is_array( $key ) && ! empty( $key ) ) {
        foreach ( $key as $item ) {
            $item = sanitize_key( $item );
            $key_array[] = $item;
        }
    }

    return $key_array;
}

/**
 * Sanitize products per page value.
 *
 * @since 1.0.0
 *
 * @param string $string String of products per page value. Default empty string.
 *
 * @return int
 */
function just_tables_sanitize_products_per_page_value( $string = '' ) {
    $value = (int) $string;

    if ( 0 === $value || -1 === $value ) {
        $products_per_page_value = $value;
    } else {
        $products_per_page_value = absint( $value );
    }

    return $products_per_page_value;
}

/**
 * String explode and sanitize array of ID.
 *
 * @since 1.0.0
 *
 * @param string $string String of ID. Default empty string.
 *
 * @return array
 */
function just_tables_string_explode_and_sanitize_array_of_id( $string = '' ) {
    $id_array = array();

    if ( is_string( $string ) && ! empty( trim( $string ) ) ) {
        $string = str_replace( ' ', '', $string );
        $string = rtrim( $string, ',' );
        $string_array = explode( ',', $string );

        foreach ( $string_array as $item ) {
            $item = absint( $item );

            if ( 0 !== $item ) {
                $id_array[] = $item;
            }
        }
    }

    return $id_array;
}

/**
 * String explode and sanitize multiple class.
 *
 * @since 1.0.0
 *
 * @param array $class String of class. Default empty string.
 *
 * @return string
 */
function just_tables_string_explode_and_sanitize_multiple_class( $string = '' ) {
    $class = '';

    if ( is_string( $string ) && ! empty( trim( $string ) ) ) {
        $string = str_replace( ',', '', $string );
        $string_array = explode( ' ', $string );

        foreach ( $string_array as $item ) {
            $item = sanitize_html_class( $item );
            $class .= ' ' . $item;
        }

        $class = trim( $class );
    }

    return $class;
}

/**
 * Column width options to css.
 *
 * @since 1.0.0
 *
 * @param array $width_options Width options array. Default empty array.
 *
 * @return string
 */
function just_tables_column_width_options_to_css( $width_options = array() ) {
    $width_value = '';

    if ( ! is_array( $width_options ) || empty( $width_options ) ) {
        return;
    }

    if ( isset( $width_options['unit'] ) && ! empty( trim( $width_options['unit'] ) ) ) {
        $width_unit = sanitize_text_field( $width_options['unit'] );
    } else {
        $width_unit = 'px';
    }

    if ( isset( $width_options['width'] ) && ( '' !== trim( $width_options['width'] ) ) ) {
        $width_value .= 'width: ' . (float) $width_options['width'] . $width_unit . ' !important; ';
        $width_value .= 'min-width: ' . (float) $width_options['width'] . $width_unit . ' !important; ';
    }

    return $width_value;
}

/**
 * Width options to css.
 *
 * @since 1.0.0
 *
 * @param array $width_options Width options array. Default empty array.
 *
 * @return string
 */
function just_tables_width_options_to_css( $width_options = array() ) {
    $width_value = '';

    if ( ! is_array( $width_options ) || empty( $width_options ) ) {
        return;
    }

    if ( isset( $width_options['unit'] ) && ! empty( trim( $width_options['unit'] ) ) ) {
        $width_unit = sanitize_text_field( $width_options['unit'] );
    } else {
        $width_unit = 'px';
    }

    if ( isset( $width_options['width'] ) && ( '' !== trim( $width_options['width'] ) ) ) {
        $width_value .= 'width: ' . (float) $width_options['width'] . $width_unit . '; ';
    }

    return $width_value;
}

/**
 * Border width options to css.
 *
 * @since 1.0.0
 *
 * @param array $border_width_options Border width options array. Default empty array.
 *
 * @return string
 */
function just_tables_border_width_options_to_css( $border_width_options = array() ) {
    $border_width_value = '';

    if ( ! is_array( $border_width_options ) || empty( $border_width_options ) ) {
        return;
    }

    if ( isset( $border_width_options['unit'] ) && ! empty( trim( $border_width_options['unit'] ) ) ) {
        $border_unit = sanitize_text_field( $border_width_options['unit'] );
    } else {
        $border_unit = 'px';
    }

    if ( isset( $border_width_options['top'] ) && ( '' !== trim( $border_width_options['top'] ) ) ) {
        $border_width_value .= 'border-top-width: ' . (float) $border_width_options['top'] . $border_unit . '; ';
    }

    if ( isset( $border_width_options['right'] ) && ( '' !== trim( $border_width_options['right'] ) ) ) {
        $border_width_value .= 'border-right-width: ' . (float) $border_width_options['right'] . $border_unit . '; ';
    }

    if ( isset( $border_width_options['bottom'] ) && ( '' !== trim( $border_width_options['bottom'] ) ) ) {
        $border_width_value .= 'border-bottom-width: ' . (float) $border_width_options['bottom'] . $border_unit . '; ';
    }

    if ( isset( $border_width_options['left'] ) && ( '' !== trim( $border_width_options['left'] ) ) ) {
        $border_width_value .= 'border-left-width: ' . (float) $border_width_options['left'] . $border_unit . '; ';
    }

    return $border_width_value;
}

/**
 * Border radius options to css.
 *
 * @since 1.0.0
 *
 * @param array $border_radius_options Border radius options array. Default empty array.
 *
 * @return string
 */
function just_tables_border_radius_options_to_css( $border_radius_options = array() ) {
    $border_radius_value = '';

    if ( ! is_array( $border_radius_options ) || empty( $border_radius_options ) ) {
        return;
    }

    if ( isset( $border_radius_options['unit'] ) && ! empty( trim( $border_radius_options['unit'] ) ) ) {
        $border_radius_unit = sanitize_text_field( $border_radius_options['unit'] );
    } else {
        $border_radius_unit = 'px';
    }

    if ( isset( $border_radius_options['top'] ) && ( '' !== trim( $border_radius_options['top'] ) ) ) {
        $border_radius_value .= 'border-top-left-radius: ' . (float) $border_radius_options['top'] . $border_radius_unit . '; ';
    }

    if ( isset( $border_radius_options['right'] ) && ( '' !== trim( $border_radius_options['right'] ) ) ) {
        $border_radius_value .= 'border-top-right-radius: ' . (float) $border_radius_options['right'] . $border_radius_unit . '; ';
    }

    if ( isset( $border_radius_options['bottom'] ) && ( '' !== trim( $border_radius_options['bottom'] ) ) ) {
        $border_radius_value .= 'border-bottom-right-radius: ' . (float) $border_radius_options['bottom'] . $border_radius_unit . '; ';
    }

    if ( isset( $border_radius_options['left'] ) && ( '' !== trim( $border_radius_options['left'] ) ) ) {
        $border_radius_value .= 'border-bottom-left-radius: ' . (float) $border_radius_options['left'] . $border_radius_unit . '; ';
    }

    return $border_radius_value;
}

/**
 * Padding options to css.
 *
 * @since 1.0.0
 *
 * @param array $padding_options Padding options array. Default empty array.
 *
 * @return string
 */
function just_tables_padding_options_to_css( $padding_options = array() ) {
    $padding_value = '';

    if ( ! is_array( $padding_options ) || empty( $padding_options ) ) {
        return;
    }

    if ( isset( $padding_options['unit'] ) && ! empty( trim( $padding_options['unit'] ) ) ) {
        $padding_unit = sanitize_text_field( $padding_options['unit'] );
    } else {
        $padding_unit = 'px';
    }

    if ( isset( $padding_options['top'] ) && ( '' !== trim( $padding_options['top'] ) ) ) {
        $padding_value .= 'padding-top: ' . (float) $padding_options['top'] . $padding_unit . '; ';
    }

    if ( isset( $padding_options['right'] ) && ( '' !== trim( $padding_options['right'] ) ) ) {
        $padding_value .= 'padding-right: ' . (float) $padding_options['right'] . $padding_unit . '; ';
    }

    if ( isset( $padding_options['bottom'] ) && ( '' !== trim( $padding_options['bottom'] ) ) ) {
        $padding_value .= 'padding-bottom: ' . (float) $padding_options['bottom'] . $padding_unit . '; ';
    }

    if ( isset( $padding_options['left'] ) && ( '' !== trim( $padding_options['left'] ) ) ) {
        $padding_value .= 'padding-left: ' . (float) $padding_options['left'] . $padding_unit . '; ';
    }

    return $padding_value;
}

/**
 * Margin options to css.
 *
 * @since 1.0.0
 *
 * @param array $margin_options Margin options array. Default empty array.
 *
 * @return string
 */
function just_tables_margin_options_to_css( $margin_options = array() ) {
    $margin_value = '';

    if ( ! is_array( $margin_options ) || empty( $margin_options ) ) {
        return;
    }

    if ( isset( $margin_options['unit'] ) && ! empty( trim( $margin_options['unit'] ) ) ) {
        $margin_unit = sanitize_text_field( $margin_options['unit'] );
    } else {
        $margin_unit = 'px';
    }

    if ( isset( $margin_options['top'] ) && ( '' !== trim( $margin_options['top'] ) ) ) {
        $margin_value .= 'margin-top: ' . (float) $margin_options['top'] . $margin_unit . '; ';
    }

    if ( isset( $margin_options['right'] ) && ( '' !== trim( $margin_options['right'] ) ) ) {
        $margin_value .= 'margin-right: ' . (float) $margin_options['right'] . $margin_unit . '; ';
    }

    if ( isset( $margin_options['bottom'] ) && ( '' !== trim( $margin_options['bottom'] ) ) ) {
        $margin_value .= 'margin-bottom: ' . (float) $margin_options['bottom'] . $margin_unit . '; ';
    }

    if ( isset( $margin_options['left'] ) && ( '' !== trim( $margin_options['left'] ) ) ) {
        $margin_value .= 'margin-left: ' . (float) $margin_options['left'] . $margin_unit . '; ';
    }

    return $margin_value;
}

/**
 * Generate table body rows.
 *
 * @since 1.0.0
 *
 * @param array $query_args Array of query arguments. Default empty array.
 * @param array $columns Array of columns. Default empty array.
 * @param array $element_configuration Array of element configuration. Default empty array.
 *
 * @return string
 */
function just_tables_generate_table_body_rows( $query_args = array(), $columns = array(), $active_columns_id = array(), $element_configuration = array(), $woocommerce_settings = array() ) {
    // Table body rows.
    $table_body_rows = '';

    // Return if arguments are wrong.
    if ( ! is_array( $query_args ) || empty( $query_args ) || ! is_array( $columns ) || empty( $columns ) || ! is_array( $active_columns_id ) || empty( $active_columns_id ) || ! is_array( $element_configuration ) || empty( $element_configuration ) || ! is_array( $woocommerce_settings ) || empty( $woocommerce_settings ) ) {
        return $table_body_rows;
    }

    // Element configuration.
    $title_on_click = isset( $element_configuration['title_on_click'] ) ? $element_configuration['title_on_click'] : 'view';
    $thumbnail_size = isset( $element_configuration['thumbnail_size'] ) ? $element_configuration['thumbnail_size'] : 'thumbnail';
    $thumbnail_on_click = isset( $element_configuration['thumbnail_on_click'] ) ? $element_configuration['thumbnail_on_click'] : 'popup';
    $view_product_button_text = isset( $element_configuration['view_product_button_text'] ) ? $element_configuration['view_product_button_text'] : 'View Product';
    $view_product_target = isset( $element_configuration['view_product_target'] ) ? $element_configuration['view_product_target'] : 'blank';
    $in_stock_status_text = isset( $element_configuration['in_stock_status_text'] ) ? $element_configuration['in_stock_status_text'] : '';
    $out_of_stock_status_text = isset( $element_configuration['out_of_stock_status_text'] ) ? $element_configuration['out_of_stock_status_text'] : '';

    // WooCommerce settings.
    $currency_symbol = isset( $woocommerce_settings['currency_symbol'] ) ? $woocommerce_settings['currency_symbol'] : '';
    $currency_position = isset( $woocommerce_settings['currency_position'] ) ? $woocommerce_settings['currency_position'] : '';
    $decimal_separator = isset( $woocommerce_settings['decimal_separator'] ) ? $woocommerce_settings['decimal_separator'] : '';
    $thousand_separator = isset( $woocommerce_settings['thousand_separator'] ) ? $woocommerce_settings['thousand_separator'] : '';
    $number_of_decimal = isset( $woocommerce_settings['number_of_decimal'] ) ? $woocommerce_settings['number_of_decimal'] : '';
    $weight_unit = isset( $woocommerce_settings['weight_unit'] ) ? $woocommerce_settings['weight_unit'] : '';
    $dimension_unit = isset( $woocommerce_settings['dimension_unit'] ) ? $woocommerce_settings['dimension_unit'] : '';

    // Products query.
    $products_query = new WP_Query( $query_args );

    // If have products.
    if ( $products_query->have_posts() ) {
        // Product count.
        $products_count = (int) 1;

        // Loop through products.
        while ( $products_query->have_posts() ) {
            $products_query->the_post();

            global $product;

            // Table body data.
            $table_body_data = '';

            // Product serial.
            $product_serial = (int) $products_count;

            // Product ID.
            $product_id = (int) $product->get_id();

            // Product type.
            $product_type = $product->get_type();

            // Product title.
            $product_title = $product->get_title();

            // Product permalink.
            $product_permalink = get_permalink();

            // Product min purchase quantity.
            $product_min_purchase_quantity = $product->get_min_purchase_quantity();

            // Product max purchase quantity.
            $product_max_purchase_quantity = $product->get_max_purchase_quantity();

            // Body columns count.
            $body_columns_count = (int) 1;

            // Loop through columns.
            foreach ( $columns as $key => $value ) {
                $column_id = isset( $value['column-id'] ) ? sanitize_key( trim( $value['column-id'] ) ) : '';
                $custom_type = isset( $value['custom-type'] ) ? sanitize_key( trim( $value['custom-type'] ) ) : 'field';
                $custom_keyword = isset( $value['custom-keyword'] ) ? sanitize_key( trim( $value['custom-keyword'] ) ) : '';
                $title_add_elements = array( 'rating', 'short-description' );
                $action_add_elements = array( 'wishlist' );

                if ( empty( $column_id ) && ! empty( $custom_type ) ) {
                    $column_id = 'custom-' . $custom_type;
                }

                $column_element = '';

                $element_file = JUST_TABLES_PATH . '/includes/Frontend/views/elements/' . sanitize_file_name( $column_id ) . '.php';
                if ( file_exists( $element_file ) ) {
                    include( $element_file );
                }

                // Table body data class.
                $table_body_data_class = 'jtpt-body-data jtpt-body-data-' . $body_columns_count;

                // Update table body data.
                if ( 1 === $body_columns_count ) {
                    $table_body_data .= '<td class="' . esc_attr( $table_body_data_class ) . '" tabindex="0">' . $column_element . '</td>';
                } else {
                    $table_body_data .= '<td class="' . esc_attr( $table_body_data_class ) . '">' . $column_element . '</td>';
                }

                // Body columns count increment.
                $body_columns_count++;
            }

            // Table body row class.
            $table_body_row_class = 'jtpt-body-row jtpt-body-row-' . $product_id;

            // Update table body rows.
            $table_body_rows .= '<tr class="' . esc_attr( $table_body_row_class ) . '" data-jtpt-product-type="' . esc_attr( $product_type ) . '" data-jtpt-product-id="' . esc_attr( $product_id ) . '" data-jtpt-min-qty="' . esc_attr( $product_min_purchase_quantity ) . '" data-jtpt-simple-min-qty="' . esc_attr( $product_min_purchase_quantity ) . '" data-jtpt-max-qty="' . esc_attr( $product_max_purchase_quantity ) . '" data-jtpt-simple-max-qty="' . esc_attr( $product_max_purchase_quantity ) . '">' . $table_body_data . '</tr>';

            // Product count increment.
            $products_count++;
        }
    }

    // Restore original Post Data.
    wp_reset_postdata();

    return $table_body_rows;
}