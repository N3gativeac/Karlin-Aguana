<?php
/**
 * JustTables Columns Options.
 *
 * Current Product Table Columns options values and default.
 * Options values generate based on user input while current Product Table created and updated.
 *
 * @since 1.0.0
 */

// Columns.
$columns = isset( $product_table_options['columns'] ) ? (array) $product_table_options['columns'] : array();

// Active columns.
$active_columns = array();
$active_columns_id = array();

// Loop through columns.
foreach ( $columns as $key => $value ) {
	$column_id = isset( $value['column-id'] ) ? sanitize_key( $value['column-id'] ) : '';
	$column_active = isset( $value['active'] ) ? rest_sanitize_boolean( $value['active'] ) : false;

	if ( $column_active && ( 'check' !== $column_id ) ) {
		$active_columns[] = $value;
		$active_columns_id[] = $column_id;
	}
}

if ( ! isset( $active_columns ) || ! is_array( $active_columns ) || empty( $active_columns ) ) {
	$active_columns = array(
		array(
			'default-heading' => esc_html__( 'Thumbnail', 'just-tables' ),
			'fixed-heading'   => esc_html__( 'Thumbnail', 'just-tables' ),
			'deletable'       => 'false',
			'column-id'       => 'thumbnail',
			'priority'        => '2',
			'sort'            => 'jtpt-no-sort',
			'active'          => true,
			'heading'         => esc_html__( 'Thumbnail', 'just-tables' ),
		),
		array(
			'default-heading'    => esc_html__( 'Product Title', 'just-tables' ),
			'fixed-heading'      => esc_html__( 'Product Title', 'just-tables' ),
			'deletable'          => 'false',
			'column-id'          => 'title',
			'priority'           => '3',
			'sort'               => 'jtpt-sort',
			'active'             => true,
			'heading'            => esc_html__( 'Product Title', 'just-tables' ),
			'title-add-elements' => array( 'rating', 'short-description' ),
		),
		array(
			'default-heading' => esc_html__( 'Categories', 'just-tables' ),
			'fixed-heading'   => esc_html__( 'Categories', 'just-tables' ),
			'deletable'       => 'false',
			'column-id'       => 'categories',
			'priority'        => '1000',
			'sort'            => 'jtpt-sort',
			'active'          => true,
			'heading'         => esc_html__( 'Categories', 'just-tables' ),
		),
		array(
			'default-heading' => esc_html__( 'Stock', 'just-tables' ),
			'fixed-heading'   => esc_html__( 'Stock', 'just-tables' ),
			'deletable'       => 'false',
			'column-id'       => 'stock',
			'priority'        => '9',
			'sort'            => 'jtpt-sort',
			'active'          => true,
			'heading'         => esc_html__( 'Stock', 'just-tables' ),
		),
		array(
			'default-heading' => esc_html__( 'Price', 'just-tables' ),
			'fixed-heading'   => esc_html__( 'Price', 'just-tables' ),
			'deletable'       => 'false',
			'column-id'       => 'price',
			'priority'        => '8',
			'sort'            => 'jtpt-sort',
			'active'          => true,
			'heading'         => esc_html__( 'Price', 'just-tables' ),
		),
		array(
			'default-heading' => esc_html__( 'Quantity', 'just-tables' ),
			'fixed-heading'   => esc_html__( 'Quantity', 'just-tables' ),
			'deletable'       => 'false',
			'column-id'       => 'quantity',
			'priority'        => '7',
			'sort'            => 'jtpt-no-sort',
			'active'          => true,
			'heading'         => esc_html__( 'Quantity', 'just-tables' ),
		),
		array(
			'default-heading'     => esc_html__( 'Action', 'just-tables' ),
			'fixed-heading'       => esc_html__( 'Action', 'just-tables' ),
			'deletable'           => 'false',
			'column-id'           => 'action',
			'priority'            => '4',
			'sort'                => 'jtpt-no-sort',
			'active'              => true,
			'heading'             => esc_html__( 'Action', 'just-tables' ),
			'action-add-elements' => array( 'wishlist' ),
		),
	);

	$active_columns_id = array( 'thumbnail', 'title', 'categories', 'stock', 'price', 'quantity', 'action' );
}