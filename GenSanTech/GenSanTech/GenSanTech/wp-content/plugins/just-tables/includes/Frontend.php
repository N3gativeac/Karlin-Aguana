<?php
/**
 * JustTables Frontend.
 *
 * @since 1.0.0
 */

namespace JustTables;

/**
 * Frontend class.
 */
class Frontend {

	/**
     * Frontend constructor.
     *
     * @since 1.0.0
     */
    function __construct() {
        new Frontend\Shortcode();

        // WooCommerce before and after quantity input field hook into action.
		add_action( 'woocommerce_before_quantity_input_field', array( $this, 'just_tables_woocommerce_before_quantity_input_field' ) );
		add_action( 'woocommerce_after_quantity_input_field', array( $this, 'just_tables_woocommerce_after_quantity_input_field' ) );
    }

    /**
	 * WooCommerce before quantity input field.
	 *
	 * @since 1.0.0
	 */
	public function just_tables_woocommerce_before_quantity_input_field() {
		echo '<div class="jtpt-qty-button decrease">-</div>';
	}

    /**
	 * WooCommerce before quantity input field.
	 *
	 * @since 1.0.0
	 */
	public function just_tables_woocommerce_after_quantity_input_field() {
		echo '<div class="jtpt-qty-button increase">+</div>';
	}

}