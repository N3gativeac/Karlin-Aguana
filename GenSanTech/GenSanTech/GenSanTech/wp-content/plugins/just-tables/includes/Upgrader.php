<?php
/**
 * JustTables Upgrader.
 *
 * @since 1.0.5
 */

namespace JustTables;

/**
 * Upgrader class.
 */
class Upgrader {

	/**
     * Version.
     *
     * @since 1.0.5
     */
	public $version = '';

	/**
     * Upgrader constructor.
     *
     * @since 1.0.5
     */
    public function __construct() {
    	$this->get_version();
        $this->upgrade_init();
        $this->upgrade_version();
    }

    /**
     * Get version.
     *
     * @since 1.0.5
     */
    public function get_version() {
        $this->version = get_option( 'just_tables_version' );
    }

    /**
     * Initialize upgrade.
     *
     * @since 1.0.5
     */
    public function upgrade_init() {
    	if ( $this->version ) {
		    $numeric_version = absint( str_replace( '.', '', $this->version ) );

		    if ( 105 > $numeric_version ) {
		        $this->upgrade_table_columns();
		    }
		}
    }

    /**
     * Upgrade table columns.
     *
     * @since 1.0.5
     */
    public function upgrade_table_columns() {
    	$product_tables = get_posts( array( 'post_type' => 'jt-product-table', 'numberposts' => -1 ) );

    	if ( is_array( $product_tables ) && ! empty( $product_tables ) ) {
    		foreach ( $product_tables as $product_table ) {
    			$product_table_id = absint( $product_table->ID );

    			if ( ! empty( $product_table_id ) ) {
    				$product_table_options = get_post_meta( $product_table_id, '_jt_product_table_options', true );

    				if ( is_array( $product_table_options ) && isset( $product_table_options['columns'] ) ) {
    					$columns = $product_table_options['columns'];
				    	$columns_id = array_column( $columns, 'column-id' );

				    	if ( ! in_array( 'compare', $columns_id ) ) {
				    		$columns[] = array(
				    			'default-heading' => esc_html__( 'Compare', 'just-tables' ),
				    			'fixed-heading'   => esc_html__( 'Compare', 'just-tables' ),
				    			'deletable'       => 'false',
				    			'column-id'       => 'compare',
				    			'priority'        => '1000',
				    			'sort'            => 'jtpt-no-sort',
				    			'active'          => '',
				    			'heading'         => esc_html__( 'Compare', 'just-tables' ),
				    			'column-width'    => array(
									'width' => '',
									'unit'  => 'px',
				    			),
				    		);

				    		$product_table_options['columns'] = $columns;
				    	}

	    				update_post_meta( $product_table_id, '_jt_product_table_options', $product_table_options );
    				}
    			}
    		}
    	}
    }

    /**
     * Upgrade version.
     *
     * @since 1.0.5
     */
    public function upgrade_version() {
    	update_option( 'just_tables_version', JUST_TABLES_VERSION );
    }

}