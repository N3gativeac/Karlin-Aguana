<?php
/**
 * JustTables Posts Columns.
 *
 * Filter Product Table posts columns of JustTables.
 *
 * @since 1.0.0
 */

namespace JustTables\Admin;

/**
 * Posts columns class.
 */
class Posts_Columns {

	/**
	 * Posts columns constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'manage_jt-product-table_posts_columns', array( $this, 'filter_posts_columns' ) );
		add_action( 'manage_jt-product-table_posts_custom_column', array( $this, 'posts_shortcode_column_content' ), 10, 2 );
	}

	/**
	 * Filter posts columns.
	 *
	 * @since 1.0.0
	 *
	 * @return array Columns array.
	 */
	public function filter_posts_columns( $columns ) {
		$columns = array(
			'cb'        => $columns['cb'],
			'title'     => $columns['title'],
			'shortcode' => esc_html__( 'Shortcode', 'just-tables' ),
			'date'      => $columns['date'],
		);

		return $columns;
	}

	/**
	 * Posts shortcode column content.
	 *
	 * @since 1.0.0
	 */
	public function posts_shortcode_column_content( $column, $post_id ) {
		$post_id = absint( $post_id );
		$shortcode = '';

		// Shortcode column
		if ( 'shortcode' === $column ) {
			if ( ! empty( $post_id ) ) {
				$shortcode = '<strong>[JT_Product_Table id="' . esc_html( $post_id ) . '"]</strong>';
			} else {
				$shortcode = '';
			}
		}

		echo $shortcode;
	}

}