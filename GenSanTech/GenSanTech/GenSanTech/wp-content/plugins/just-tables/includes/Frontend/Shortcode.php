<?php
/**
 * JustTables Shortcode.
 *
 * @since 1.0.0
 */

namespace JustTables\Frontend;

/**
 * Shortcode class.
 */
class Shortcode {

	/**
     * Shortcode constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {
    	add_shortcode( 'JT_Product_Table', array( $this, 'render_shortcode' ) );
    }

    /**
     * Render shortcode.
     *
     * @since 1.0.0
     *
     * @param array $atts Shortcode attributes.
     */
    public function render_shortcode( $atts ) {
    	$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts,
			'JT_Product_Table'
		);

		$table_id = absint( $atts['id'] );

		$invalid_shortcode_message = '<p class="jtpt-shortcode-error">' . esc_html__( 'Please provide a valid shortcode!', 'just-tables' ) . '</p>';

		if ( empty( $table_id ) ) {
			return $invalid_shortcode_message;
		}

		$product_table = get_post( $table_id );

		if ( empty( $product_table ) || ( 'jt-product-table' !== $product_table->post_type ) ) {
			return $invalid_shortcode_message;
		}

		$product_table_status = $product_table->post_status;

		if ( 'trash' === $product_table_status ) {
			return $invalid_shortcode_message;
		}

		if ( ( 'publish' !== $product_table_status ) && ! current_user_can( 'read', $table_id ) ) {
			return;
		}

		if ( post_password_required( $table_id ) ) {
			return get_the_password_form();
		} else {
			$product_table_options = get_post_meta( $table_id, '_jt_product_table_options', true );

			if ( ! isset( $product_table_options ) || ! is_array( $product_table_options ) || empty( $product_table_options ) ) {
				$product_table_options = array();
			}

			include __DIR__ . '/views/columns-options.php';
			include __DIR__ . '/views/config-options.php';
			include __DIR__ . '/views/table.php';

			if ( ! isset( $table_html ) || ! is_string( $table_html ) || empty( $table_html ) ) {
				$table_html = '';
			}

			return $table_html;
		}
    }

}