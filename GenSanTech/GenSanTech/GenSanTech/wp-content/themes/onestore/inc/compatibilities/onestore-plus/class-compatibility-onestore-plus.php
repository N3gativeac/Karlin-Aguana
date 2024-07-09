<?php
/**
 * Plugin compatibility: OneStore Pro
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

class OneStore_Compatibility_OneStore_Pro {

	/**
	 * Singleton instance
	 *
	 * @var OneStore_Compatibility_OneStore_Pro
	 */
	private static $instance;

	/**
	 * ====================================================
	 * Singleton & constructor functions
	 * ====================================================
	 */

	/**
	 * Get singleton instance.
	 *
	 * @return OneStore_Compatibility_OneStore_Pro
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Class constructor
	 */
	protected function __construct() {
		/**
		 * Compatibility for OneStore Pro prior to v1.1.0.
		 */

		// Get the main version without suffix like "dev", "alpha", "beta".
		if ( defined( 'ONESTORE_PRO_VERSION' ) && version_compare( preg_replace( '/\-.*/', '', ONESTORE_PRO_VERSION ), '1.1.0', '<' ) ) {
			// Add legacy "woocommerce-advanced" module and hide the new modules.
			// Use "0" priority because the legacy "woocommerce-advanced" module needs to be added before any other filters run.
			add_filter( 'onestore/pro/modules', array( $this, 'fallback_compatibility_for_legacy_woocommerce_advanced_module' ), 0 );

			// Add fallback compatibility for all OneStore Pro modules dynamic CSS.
			// Since OneStore v1.1.0, all dynamic CSS are printed using 'wp_add_inline_style' instead of manual printing on 'wp_head'.
			add_filter( 'onestore/frontend/inline_css', array( $this, 'fallback_compatibility_for_customizer_inline_css' ) );
		}
	}
	
	/**
	 * ====================================================
	 * Hook functions
	 * ====================================================
	 */

	/**
	 * Add legacy "woocommerce-advanced" module and hide the new modules.
	 *
	 * @param array $modules
	 * @return array
	 */
	public function fallback_compatibility_for_legacy_woocommerce_advanced_module( $modules ) {
		$pro_active_modules = get_option( 'onestore_pro_active_modules', array() );

		// Hide the new modules.
		foreach ( $modules as $module_slug => $module_data ) {
			if ( 'woocommerce' === $module_data['category'] ) {
				$modules[ $module_slug ]['hide'] = true;
			}
		}

		// Add legacy "woocommerce-advanced" module.
		$modules['woocommerce-advanced'] = array(
			'label'    => esc_html__( 'WooCommerce Advanced (Legacy)', 'onestore' ),
			'category' => 'woocommerce',
			'url'      => esc_url( add_query_arg( array( 'utm_source' => 'onestore-dashboard', 'utm_medium' => 'learn-more', 'utm_campaign' => 'theme-pro-modules-list' ), trailingslashit( ONESTORE_PLUS_URL ) ) ),
		);

		return $modules;
	}

	/**
	 * Add fallback compatibility for all OneStore Pro modules dynamic CSS.
	 *
	 * @param string $css
	 * @return string
	 */
	public function fallback_compatibility_for_customizer_inline_css( $css ) {
		$postmessages = array();
		$active_modules = get_option( 'onestore_pro_active_modules', array() );

		foreach ( $active_modules as $i => $module_slug ) {
			// Skip Advanced WooCommerce module if it's activated but no WooCommerce class is found.
			if ( 'woocommerce' === substr( $module_slug, 0, 11 ) && ! class_exists( 'WooCommerce' ) ) {
				continue;
			}

			$postmessages_file = ONESTORE_PRO_DIR . 'inc/modules/' . $module_slug . '/customizer/postmessages.php';

			if ( file_exists( $postmessages_file ) ) {
				include( $postmessages_file );
			}
		} 

		$generated_css = OneStore_Customizer::instance()->convert_postmessages_to_css_string( $postmessages );

		if ( ! empty( $generated_css ) ) {
			$css = "\n/* OneStore Pro Dynamic CSS (fallback compatibility prior OneStore Pro v1.1.0) */\n" . $generated_css;
		}

		return $css;
	}
}

OneStore_Compatibility_OneStore_Pro::instance();