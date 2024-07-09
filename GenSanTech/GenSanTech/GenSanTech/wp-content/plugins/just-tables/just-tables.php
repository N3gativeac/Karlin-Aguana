<?php
/**
 * Plugin Name: JustTables - Product Tables for WooCommerce
 * Plugin URI:  https://hasthemes.com/wp/justtables/
 * Description: Display WooCommerce products as table.
 * Version:     1.1.0
 * Author:      HasThemes
 * Author URI:  https://hasthemes.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: just-tables
 * Domain Path: /languages
 */

// If this file is accessed directly, exit.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main JustTables class.
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'JustTables' ) ) {
	final class JustTables {

		/**
	     * JustTables version.
	     *
	     * @since 1.0.0
	     *
	     * @var string $version
	     */
		public $version = '1.1.0';

		/**
		 * The single instance of the class.
		 *
		 * @since 1.0.0
		 *
		 * @var \JustTables $_instance
		 */
		protected static $_instance = null;

		/**
		 * Main JustTables Instance.
		 *
		 * Ensures only one instance of JustTables is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 *
		 * @static
		 * @see just_tables()
		 *
		 * @return \JustTables - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * JustTables Constructor.
		 *
		 * @since 1.0.0
		 */
		private function __construct() {
			$this->define_constants();
			$this->includes();
			$this->init_hooks();
		}

		/**
	     * Define the required constants.
	     *
	     * @since 1.0.0
	     */
	    private function define_constants() {
	        define( 'JUST_TABLES_VERSION', $this->version );
	        define( 'JUST_TABLES_FILE', __FILE__ );
	        define( 'JUST_TABLES_PATH', __DIR__ );
	        define( 'JUST_TABLES_URL', plugins_url( '', JUST_TABLES_FILE ) );
	        define( 'JUST_TABLES_ASSETS', JUST_TABLES_URL . '/assets' );
	    }

		/**
		 * Include required core files and libraries.
		 *
		 * @since 1.0.0
		 */
		public function includes() {
			/**
			 * Including Codestar Framework.
			 */
			if ( ! class_exists( 'CSF' ) ) {
				require_once JUST_TABLES_PATH .'/libs/codestar-framework/codestar-framework.php';
			}

			/**
			 * Composer autoload file.
			 */
			require_once JUST_TABLES_PATH . '/vendor/autoload.php';

			/**
			 * Including plugin file for secutiry purpose.
			 */
			if ( ! function_exists( 'is_plugin_active' ) ) {
				include_once ABSPATH . 'wp-admin/includes/plugin.php';
			}
		}

		/**
		 * Hook into actions and filters.
		 *
		 * @since 1.0.0
		 */
		private function init_hooks() {
			register_activation_hook( JUST_TABLES_FILE, array( $this, 'activate' ) );

			if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				add_action( 'admin_notices', array( $this, 'build_dependencies_notice' ) );
			} else {
				add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
				add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
			}
		}

	    /**
	     * Do stuff upon plugin activation.
	     *
	     * @since 1.0.0
	     */
	    public function activate() {
	    	new JustTables\Installer();
	    }

		/**
		 * Load the plugin textdomain
		 *
		 * @since 1.0.0
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'just-tables', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Initialize the plugin
		 *
		 * @since 1.0.0
		 */
		public function init_plugin() {
			if ( is_admin() ) {
				new JustTables\Admin();
			}
			new JustTables\Frontend();
			new JustTables\Assets();
			new JustTables\Upgrader();
		}

	   /**
	    * Check plugin is installed or not.
	    *
	    * @since 1.0.0
	    *
	    * @param string $plugin_file_path plugin file path
	    *
	    * @return boolean
	    */
	    public function is_plugins_active( $plugin_file_path = null ){
	        $installed_plugins_list = get_plugins();
	        return isset( $installed_plugins_list[ $plugin_file_path ] );
	    }

		/**
		 * Output a admin notice when build dependencies not met.
		 *
		 * @since 1.0.0
		 */
		public function build_dependencies_notice() {
			$woocommerce = 'woocommerce/woocommerce.php';

	        if( $this->is_plugins_active( $woocommerce ) ) {
	            if( ! current_user_can( 'activate_plugins' ) ) {
	                return;
	            }

	            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $woocommerce . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $woocommerce );
	            $message = sprintf( esc_html__( '%1$sJustTables - Product Tables for WooCommerce%2$s requires %1$s"WooCommerce"%2$s plugin to be active. Please activate WooCommerce to continue.', 'just-tables' ), '<strong>', '</strong>');
	            $button_text = esc_html__( 'Activate WooCommerce', 'just-tables' );
	        } else {
	            if( ! current_user_can( 'activate_plugins' ) ) {
	                return;
	            }

	            $activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' );
	            $message = sprintf( esc_html__( '%1$sJustTables - Product Tables for WooCommerce%2$s requires %1$s"WooCommerce"%2$s plugin to be installed and activated. Please install WooCommerce to continue.', 'just-tables' ), '<strong>', '</strong>' );
	            $button_text = esc_html__( 'Install WooCommerce', 'just-tables' );
	        }
	        $button = '<p><a href="' . esc_url( $activation_url ) . '" class="button-primary">' . $button_text . '</a></p>';

	        printf( '<div class="notice notice-error"><p>%1$s</p>%2$s</div>', $message, $button );
		}

	}

	/**
	 * Returns the main instance of JustTables.
	 *
	 * @since 1.0.0
	 *
	 * @return \JustTables
	 */
	function just_tables() {
		return JustTables::instance();
	}

	// Kick-off the plugin.
	just_tables();
}