<?php
/**
 * JustTables Assets.
 *
 * @since 1.0.0
 */

namespace JustTables;

/**
 * Assets class.
 */
class Assets {

	/**
	 * Assets constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_assets' ), 99 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ), 99 );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_assets' ), 99 );
	}

	/**
	 * Get frontend styles.
	 *
	 * Get all frontend stylesheet (style) file of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return array List of frontend stylesheet (style) files.
	 */
	public function get_frontend_styles() {
		return array(
			'dataTables' => array(
				'src' => JUST_TABLES_ASSETS . '/css/jquery.dataTables.min.css',
				'version' => '1.10.22',
			),
			'dataTables-responsive' => array(
				'src' => JUST_TABLES_ASSETS . '/css/responsive.dataTables.min.css',
				'version' => '2.2.6',
				'deps' => array( 'dataTables' ),
			),
			'dataTables-buttons' => array(
				'src' => JUST_TABLES_ASSETS . '/css/buttons.dataTables.min.css',
				'version' => '1.6.5',
				'deps' => array( 'dataTables' ),
			),
			'select2' => array(
				'src' => JUST_TABLES_ASSETS . '/css/select2.css',
			),
			'flaticon' => array(
				'src' => JUST_TABLES_ASSETS . '/css/flaticon.min.css',
			),
			'just-tables' => array(
				'src' => JUST_TABLES_ASSETS . '/css/just-tables.css',
			),
		);
	}

	/**
	 * Get frontend scripts.
	 *
	 * Get all frontend JavaScript (script) file of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return array List of frontend JavaScript (script) files.
	 */
	public function get_frontend_scripts() {
		return array(
			'dataTables' => array(
				'src' => JUST_TABLES_ASSETS . '/js/jquery.dataTables.min.js',
				'version' => '1.10.22',
				'deps' => array( 'jquery' ),
			),
			'dataTables-responsive' => array(
				'src' => JUST_TABLES_ASSETS . '/js/dataTables.responsive.min.js',
				'version' => '2.2.6',
				'deps' => array( 'dataTables' ),
			),
			'dataTables-buttons' => array(
				'src' => JUST_TABLES_ASSETS . '/js/dataTables.buttons.min.js',
				'version' => '1.6.5',
				'deps' => array( 'dataTables' ),
			),
			'jszip' => array(
				'src' => JUST_TABLES_ASSETS . '/js/jszip.min.js',
				'version' => '3.1.3',
				'deps' => array( 'dataTables' ),
			),
			'pdfmake' => array(
				'src' => JUST_TABLES_ASSETS . '/js/pdfmake.min.js',
				'version' => '0.1.53',
				'deps' => array( 'dataTables' ),
			),
			'pdfmake-vfs_fonts' => array(
				'src' => JUST_TABLES_ASSETS . '/js/vfs_fonts.js',
				'version' => '0.1.53',
				'deps' => array( 'pdfmake' ),
			),
			'dataTables-colVis' => array(
				'src' => JUST_TABLES_ASSETS . '/js/buttons.colVis.min.js',
				'version' => '1.6.5',
				'deps' => array( 'dataTables' ),
			),
			'dataTables-flash' => array(
				'src' => JUST_TABLES_ASSETS . '/js/buttons.flash.min.js',
				'version' => '1.6.5',
				'deps' => array( 'dataTables' ),
			),
			'dataTables-html5' => array(
				'src' => JUST_TABLES_ASSETS . '/js/buttons.html5.min.js',
				'version' => '1.3.3',
				'deps' => array( 'dataTables' ),
			),
			'dataTables-print' => array(
				'src' => JUST_TABLES_ASSETS . '/js/buttons.print.min.js',
				'version' => '1.6.5',
				'deps' => array( 'dataTables' ),
			),
			'select2' => array(
				'src' => JUST_TABLES_ASSETS . '/js/select2.full.min.js',
				'version' => '4.0.3',
				'deps' => array( 'jquery' ),
			),
			'just-tables' => array(
				'src' => JUST_TABLES_ASSETS . '/js/just-tables.js',
				'deps' => array( 'jquery', 'dataTables' ),
			),
			'just-tables-ajax' => array(
				'src' => JUST_TABLES_ASSETS . '/js/just-tables-ajax.js',
				'deps' => array( 'jquery', 'just-tables' ),
			),
		);
	}

	/**
	 * Register frontend assets.
	 *
	 * @since 1.0.0
	 */
	public function register_frontend_assets() {
		// Styles.
		$styles = $this->get_frontend_styles();

		foreach ( $styles as $handle => $style ) {
			$style_deps = isset( $style['deps'] ) ? $style['deps'] : array();
			$style_version = isset( $style['version'] ) ? $style['version'] : JUST_TABLES_VERSION;

			wp_register_style( $handle, $style['src'], $style_deps, $style_version );
		}

		// Scripts.
		$scripts = $this->get_frontend_scripts();

		foreach ( $scripts as $handle => $script ) {
			$script_deps = isset( $script['deps'] ) ? $script['deps'] : array();
			$script_version = isset( $script['version'] ) ? $script['version'] : JUST_TABLES_VERSION;
			$in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : true;

			wp_register_script( $handle, $script['src'], $script_deps, $script_version, $in_footer );
		}

		// Localize script.
		if ( class_exists( '\Elementor\Plugin' ) && ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) ) {
			$localize_script_data = array( 'elementor_editor_mode' => 'true' );
		} else {
			$localize_script_data = array( 'elementor_editor_mode' => 'false' );
		}

		wp_localize_script( 'just-tables', 'jtpt_object', $localize_script_data );

		// Ajax localize script.
		$ajax_localize_script_data = array( 'ajax_url' => admin_url( 'admin-ajax.php' ) );

		wp_localize_script( 'just-tables-ajax', 'jtpt_ajax_object', $ajax_localize_script_data );
	}

	/**
	 * Enqueue frontend assets.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_frontend_assets() {
		// Thickbox.
		add_thickbox();

		// Styles.
		$styles = $this->get_frontend_styles();

		foreach ( $styles as $handle => $style ) {
			wp_enqueue_style( $handle );
		}

		// Scripts.
		$scripts = $this->get_frontend_scripts();

		foreach ( $scripts as $handle => $script ) {
			wp_enqueue_script( $handle );
		}
	}

	/**
	 * Get admin styles.
	 *
	 * Get all admin stylesheet (style) file of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return array List of admin stylesheet (style) files.
	 */
	public function get_admin_styles() {
		return array(
			'just-tables-admin' => array(
				'src' => JUST_TABLES_ASSETS . '/css/just-tables-admin.css',
				'deps' => array( 'csf' ),
			),
		);
	}

	/**
	 * Get admin scripts.
	 *
	 * Get all admin JavaScript (script) file of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return array List of admin JavaScript (script) files.
	 */
	public function get_admin_scripts() {
		return array(
			'just-tables-admin' => array(
				'src' => JUST_TABLES_ASSETS . '/js/just-tables-admin.js',
				'deps' => array( 'jquery', 'csf' ),
			),
		);
	}

	/**
	 * Register admin assets.
	 *
	 * @since 1.0.0
	 */
	public function register_admin_assets() {
		// Styles.
		$styles = $this->get_admin_styles();

		foreach ( $styles as $handle => $style ) {
			$style_deps = isset( $style['deps'] ) ? $style['deps'] : array();
			$style_version = isset( $style['version'] ) ? $style['version'] : JUST_TABLES_VERSION;

			wp_register_style( $handle, $style['src'], $style_deps, $style_version );
		}

		// Scripts.
		$scripts = $this->get_admin_scripts();

		foreach ( $scripts as $handle => $script ) {
			$script_deps = isset( $script['deps'] ) ? $script['deps'] : array();
			$script_version = isset( $script['version'] ) ? $script['version'] : JUST_TABLES_VERSION;
			$in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : true;

			wp_register_script( $handle, $script['src'], $script_deps, $script_version, $in_footer );
		}
	}

}