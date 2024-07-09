<?php
/**
 * Plugin compatibility: Elementor Pro
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

class OneStore_Compatibility_Elementor_Pro {

	/**
	 * Singleton instance
	 *
	 * @var OneStore_Compatibility_Elementor_Pro
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
	 * @return OneStore_Compatibility_Elementor_Pro
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
		// Add support for Theme Builder.
		add_action( 'elementor/theme/register_locations', array( $this, 'register_elementor_locations' ) );
	}
	
	/**
	 * ====================================================
	 * Hook functions
	 * ====================================================
	 */

	/**
	 * Register all template locations for Elementor Pro's Theme Builder.
	 *
	 * @param \ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager
	 */
	public function register_elementor_locations( $elementor_theme_manager ) {
		global $wp_filter;

		// Manually register theme builder location for header and footer.
		// Why? Because header and footer need to be embedded inside the theme's template tag for better accessibility and SEO.
		foreach ( array( 'header', 'footer' ) as $location ) {
			$hook = 'onestore/frontend/' . $location;
			$hook_object = onestore_array_value( $wp_filter, $hook );

			// Build an array of all attached actions on this hook that would be removed.
			$remove_hooks = array();
			if ( is_a( $hook_object, 'WP_Hook' ) ) {
				foreach ( $hook_object->callbacks as $priority => $idxs ) {
					foreach ( $idxs as $idx => $callback ) {
						$remove_hooks[] = $callback['function'];
					}
				}
			}

			// Register location.
			$elementor_theme_manager->register_location( $location, array(
				'hook' => $hook,
				'remove_hooks' => $remove_hooks,
			) );
		}
	}
}

OneStore_Compatibility_Elementor_Pro::instance();