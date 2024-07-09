<?php
/**
 * JustTables Admin.
 *
 * @since 1.0.0
 */

namespace JustTables;

/**
 * Admin class.
 */
class Admin {

	/**
	 * Admin constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		new Admin\Post_Types();
		new Admin\Metabox();
		new Admin\Posts_Columns();

		// Admin assets hook into action.
		add_action( 'admin_head', array( $this, 'enqueue_admin_assets' ) );
	}

	/**
	 * Enqueue admin assets.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_admin_assets() {
		$current_screen = get_current_screen();

		if ( 'post' === $current_screen->base && 'jt-product-table' === $current_screen->post_type ) {
			// WP core dialog
            wp_enqueue_style( 'wp-jquery-ui-dialog' );
            wp_enqueue_script( 'jquery-ui-dialog' );

			wp_enqueue_style( 'just-tables-admin' );
			wp_enqueue_script( 'just-tables-admin' );
		}
	}

}