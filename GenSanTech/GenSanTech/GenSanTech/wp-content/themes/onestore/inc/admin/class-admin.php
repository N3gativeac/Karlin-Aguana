<?php
/**
 * OneStore Admin page basic functions
 *
 * @package OneStore
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class OneStore_Admin {
	/**
	 * Singleton instance
	 *
	 * @var OneStore_Admin
	 */
	private static $instance;

	/**
	 * Parent menu slug of all theme pages
	 *
	 * @var string
	 */
	private $_menu_id = 'onestore';

	/**
	 * ====================================================
	 * Singleton & constructor functions
	 * ====================================================
	 */

	/**
	 * Get singleton instance.
	 *
	 * @return OneStore_Admin
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
		// General admin hooks on every admin pages.
		if ( is_admin() ) {
			add_action( 'wp', array( $this, 'remove_hooks' ), 1 );
		}

		add_action( 'admin_menu', array( $this, 'register_admin_menu' ), 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_javascripts' ) );


		add_action( 'admin_notices', array( $this, 'add_rating_notice' ) );
		add_action( 'wp_ajax_onestore_rating_notice_close', array( $this, 'ajax_dismiss_rating_notice' ) );
		add_action( 'after_switch_theme', array( $this, 'reset_rating_notice_flag' ) );

		add_action( 'wp_ajax_onestore_install_sites_import_plugin', array( $this, 'ajax_install_sites_import_plugin' ) );

		// Classic editor hooks
		add_action( 'admin_init', array( $this, 'add_editor_css' ) );
		add_filter( 'tiny_mce_before_init', array( $this, 'add_classic_editor_custom_css' ) );
		add_filter( 'tiny_mce_before_init', array( $this, 'add_classic_editor_body_class' ) );
		add_filter( 'block_editor_settings', array( $this, 'add_gutenberg_custom_css' ) );

		// OneStore admin page hooks
		add_action( 'onestore/admin/dashboard/header', array( $this, 'render_admin_page__logo' ), 10 );
		add_action( 'onestore/admin/dashboard/content', array( $this, 'render_admin_page__modules' ), 10 );
		add_action( 'onestore/admin/dashboard/sidebar', array( $this, 'render_sidebar__sites' ), 10 );
		add_action( 'onestore/admin/dashboard/sidebar', array( $this, 'render_sidebar__links' ), 20 );

		$this->_includes();
	}

	/**
	 * Remove Class Filter Without Access to Class Object
	 *
	 * In order to use the core WordPress remove_filter() on a filter added with the callback
	 * to a class, you either have to have access to that class object, or it has to be a call
	 * to a static method.  This method allows you to remove filters with a callback to a class
	 * you don't have access to.
	 *
	 * Works with WordPress 1.2+ (4.7+ support added 9-19-2016)
	 * Updated 2-27-2017 to use internal WordPress removal for 4.7+ (to prevent PHP warnings output)
	 *
	 * @param string $tag         Filter to remove
	 * @param string $class_name  Class name for the filter's callback
	 * @param string $method_name Method name for the filter's callback
	 * @param int    $priority    Priority of the filter (default 10)
	 *
	 * @return bool Whether the function is removed.
	 */
	public function remove_class_filter( $tag, $class_name = '', $method_name = '', $priority = 10 ) {
		global $wp_filter;

		// Check that filter actually exists first.
		if ( ! isset( $wp_filter[ $tag ] ) ) {
			return false;
		}

		/**
		 * If filter config is an object, means we're using WordPress 4.7+ and the config is no longer
		 * a simple array, rather it is an object that implements the ArrayAccess interface.
		 *
		 * To be backwards compatible, we set $callbacks equal to the correct array as a reference (so $wp_filter is updated)
		 *
		 * @see https://make.wordpress.org/core/2016/09/08/wp_hook-next-generation-actions-and-filters/
		 */
		if ( is_object( $wp_filter[ $tag ] ) && isset( $wp_filter[ $tag ]->callbacks ) ) {
			// Create $fob object from filter tag, to use below.
			$fob = $wp_filter[ $tag ];
			$callbacks = &$wp_filter[ $tag ]->callbacks;
		} else {
			$callbacks = &$wp_filter[ $tag ];
		}

		// Exit if there aren't any callbacks for specified priority.
		if ( ! isset( $callbacks[ $priority ] ) || empty( $callbacks[ $priority ] ) ) {
			return false;
		}

		// Loop through each filter for the specified priority, looking for our class & method.
		foreach ( (array) $callbacks[ $priority ] as $filter_id => $filter ) {

			// Filter should always be an array - array( $this, 'method' ), if not goto next.
			if ( ! isset( $filter['function'] ) || ! is_array( $filter['function'] ) ) {
				continue;
			}

			// If first value in array is not an object, it can't be a class.
			if ( ! is_object( $filter['function'][0] ) ) {
				continue;
			}

			// Method doesn't match the one we're looking for, goto next.
			if ( $filter['function'][1] !== $method_name ) {
				continue;
			}

			// Method matched, now let's check the Class
			if ( get_class( $filter['function'][0] ) === $class_name ) {

				// WordPress 4.7+ use core remove_filter() since we found the class object.
				if ( isset( $fob ) ) {
					// Handles removing filter, reseting callback priority keys mid-iteration, etc.
					$fob->remove_filter( $tag, $filter['function'], $priority );

				} else {
					// Use legacy removal process (pre 4.7).
					unset( $callbacks[ $priority ][ $filter_id ] );
					// and if it was the only filter in that priority, unset that priority.
					if ( empty( $callbacks[ $priority ] ) ) {
						unset( $callbacks[ $priority ] );
					}
					// and if the only filter for that tag, set the tag to an empty array.
					if ( empty( $callbacks ) ) {
						$callbacks = array();
					}
					// Remove this filter from merged_filters, which specifies if filters have been sorted.
					unset( $GLOBALS['merged_filters'][ $tag ] );
				}

				return true;
			}
		}

		return false;
	}

	public function remove_hooks() {
		$this->remove_class_filter( 'admin_notices', 'THNotice', 'admin_notice' );
		$this->remove_class_filter( 'admin_enqueue_scripts', 'THNotice', 'notice_scripts' );
	}

	/**
	 * Include additional files.
	 */
	private function _includes() {
		require_once ONESTORE_INCLUDES_DIR . '/admin/class-admin-fields.php';

		// Only include metabox on post add/edit page and term add/edit page.
		global $pagenow;
		if ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'edit-tags.php', 'term.php' ) ) ) {
			require_once ONESTORE_INCLUDES_DIR . '/admin/class-admin-metabox-page-settings.php';
		}
	}

	/**
	 * ====================================================
	 * Hook functions
	 * ====================================================
	 */

	/**
	 * Add admin submenu page: Appearance > OneStore.
	 */
	public function register_admin_menu() {
		add_theme_page(
			onestore_get_theme_info( 'name' ),
			onestore_get_theme_info( 'name' ),
			'edit_theme_options',
			'onestore',
			array( $this, 'render_admin_page' )
		);

		/**
		 * Hook: onestore/admin/menu
		 */
		do_action( 'onestore/admin/menu' );
	}

	/**
	 * Enqueue admin styles.
	 *
	 * @param string $hook
	 */
	public function enqueue_admin_styles( $hook ) {
		/**
		 * Hook: Styles to be included before admin CSS
		 */
		do_action( 'onestore/admin/before_enqueue_admin_css', $hook );

		// Register CSS files
		wp_register_style( 'alpha-color-picker', ONESTORE_CSS_URL . '/vendors/alpha-color-picker' . ONESTORE_ASSETS_SUFFIX . '.css', array( 'wp-color-picker' ), ONESTORE_VERSION );

		// Enqueue CSS files
		wp_enqueue_style( 'onestore-admin', ONESTORE_CSS_URL . '/admin/admin.css', array(), ONESTORE_VERSION );
		wp_style_add_data( 'onestore-admin', 'rtl', 'replace' );

		/**
		 * Hook: Styles to be included after admin CSS
		 */
		do_action( 'onestore/admin/after_enqueue_admin_css', $hook );
	}

	/**
	 * Enqueue admin javascripts.
	 *
	 * @param string $hook
	 */
	public function enqueue_admin_javascripts( $hook ) {
		// Fetched version from package.json
		$ver = array();

		/**
		 * Hook: Styles to be included before admin JS
		 */
		do_action( 'onestore/admin/before_enqueue_admin_js', $hook );

		// Register JS files
		wp_register_script( 'alpha-color-picker', ONESTORE_JS_URL . '/vendors/alpha-color-picker' . ONESTORE_ASSETS_SUFFIX . '.js', array( 'jquery', 'wp-color-picker' ), ONESTORE_VERSION, true );

		// Enqueue JS files.
		wp_enqueue_script( 'onestore-admin', ONESTORE_JS_URL . '/admin/admin' . ONESTORE_ASSETS_SUFFIX . '.js', array( 'jquery' ), ONESTORE_VERSION, true );

		// Send data to main JS file.
		wp_localize_script(
			'onestore-admin',
			'OneStoreAdminData',
			array(
				'ajax_nonce'         => wp_create_nonce( 'onestore' ),
				'sitesImportPageURL' => esc_url( add_query_arg( array( 'page' => 'onestore-sites-import' ), admin_url( 'themes.php' ) ) ),
				'strings'            => array(
					'installing'               => esc_html__( 'Installing...', 'onestore' ),
					'error_installing_plugin'  => esc_html__( 'Error occured while installing the plugin', 'onestore' ),
					'redirecting_to_demo_list' => esc_html__( 'Redirecting to demo list...', 'onestore' ),
				),
			)
		);

		// Color picker Style
		wp_enqueue_style( 'wp-color-picker' );

		// Update CSS within in Admin.
		wp_enqueue_style( 'onestore-widgets', ONESTORE_CSS_URL . '/admin/widgets.css' );

		wp_enqueue_media();
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'onestore-widgets', ONESTORE_JS_URL . '/admin/widgets.js', array( 'jquery' ), '', true );

		/**
		 * Hook: Styles to be included after admin JS
		 */
		do_action( 'onestore/admin/after_enqueue_admin_js', $hook );
	}

	

	/**
	 * Add notice to give rating on WordPress.org.
	 */
	public function add_rating_notice() {
		$time_interval = strtotime( '-7 days' );

		$installed_time = get_option( 'onestore_installed_time' );
		if ( ! $installed_time ) {
			$installed_time = time();
			update_option( 'onestore_installed_time', $installed_time );
		}

		// Abort if:
		// - OneStore is installed less than 7 days.
		// - The notice is already dismissed before.
		// - Current user can't manage options.
		if ( $installed_time > $time_interval || intval( get_option( 'onestore_rating_notice_is_dismissed', 0 ) ) || ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		?>
		<div class="notice notice-info onestore-rating-notice">
			<p><?php esc_html_e( 'Hey, it\'s me OneStore WordPress theme. I noticed you\'ve been using OneStore to build your website - that\'s awesome!', 'onestore' ); ?><br><?php esc_html_e( 'Could you do us a BIG favor and give it a 5-star rating on WordPress.org? It would boost our motivation to keep adding new features in the future.', 'onestore' ); ?></p>
			<p>
				<a href="https://wordpress.org/support/theme/onestore/reviews/?rate=5#new-post" class="button button-primary" target="_blank" rel="noopener"><?php esc_html_e( 'Okay, you deserve it', 'onestore' ); ?></a>&nbsp;&nbsp;&nbsp;
				<a href="#" class="onestore-rating-notice-close button-link" data-onestore-rating-notice-repeat="<?php echo esc_attr( $time_interval ); ?>"><?php esc_html_e( 'Nope, maybe later', 'onestore' ); ?></a>&nbsp;&nbsp;&nbsp;
				<a href="#" class="onestore-rating-notice-close button-link" data-onestore-rating-notice-repeat="-1"><?php esc_html_e( 'I already did', 'onestore' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Reset theme installed time, for rating notice purpose.
	 */
	public function reset_rating_notice_flag() {
		update_option( 'onestore_installed_time', time() );
		update_option( 'onestore_rating_notice_is_dismissed', 0 );
	}

	/**
	 * Add CSS for editor page.
	 */
	public function add_editor_css() {
		add_editor_style( ONESTORE_CSS_URL . '/admin/editor' . ONESTORE_ASSETS_SUFFIX . '.css' );

		add_editor_style( OneStore_Customizer::instance()->generate_active_google_fonts_embed_url() );
	}

	/**
	 * Add custom CSS to classic editor.
	 *
	 * @param array $settings
	 * @return array
	 */
	public function add_classic_editor_custom_css( $settings ) {
		// Skip Gutenberg editor page.
		$current_screen = get_current_screen();
		if ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {
			return $settings;
		}

		global $post;

		if ( empty( $post ) ) {
			return $settings;
		}

		$css_array = array(
			'global' => array(),
		);

		// TinyMCE HTML
		$css_array['global']['html']['background-color'] = '#fcfcfc';

		// Typography
		$active_google_fonts = array();
		$typography_types = array(
			'body' => 'body',
			'blockquote' => 'blockquote',
			'h1' => 'h1',
			'h2' => 'h2',
			'h3' => 'h3',
			'h4' => 'h4',
		);
		$fonts = onestore_get_all_fonts();

		foreach ( $typography_types as $type => $selector ) {
			// Font Family
			$font_family = onestore_get_theme_mod( $type . '_font_family' );
			$font_stack = $font_family;
			if ( '' !== $font_family && 'inherit' !== $font_family ) {
				$chunks = explode( '|', $font_family );
				if ( 2 === count( $chunks ) ) {
					$font_stack = onestore_array_value( $fonts[ $chunks[0] ], $chunks[1], $chunks[1] );
				}
			}
			if ( ! empty( $font_stack ) ) {
				$css_array['global'][ $selector ]['font-family'] = $font_stack;
			}

			// Font weight
			$font_weight = onestore_get_theme_mod( $type . '_font_weight' );
			if ( ! empty( $font_weight ) ) {
				$css_array['global'][ $selector ]['font-weight'] = $font_weight;
			}

			// Font style
			$font_style = onestore_get_theme_mod( $type . '_font_style' );
			if ( ! empty( $font_style ) ) {
				$css_array['global'][ $selector ]['font-style'] = $font_style;
			}

			// Text transform
			$text_transform = onestore_get_theme_mod( $type . '_text_transform' );
			if ( ! empty( $text_transform ) ) {
				$css_array['global'][ $selector ]['text-transform'] = $text_transform;
			}

			// Font size
			$font_size = onestore_get_theme_mod( $type . '_font_size' );
			if ( ! empty( $font_size ) ) {
				$css_array['global'][ $selector ]['font-size'] = $font_size;
			}

			// Line height
			$line_height = onestore_get_theme_mod( $type . '_line_height' );
			if ( ! empty( $line_height ) ) {
				$css_array['global'][ $selector ]['line-height'] = $line_height;
			}

			// Letter spacing
			$letter_spacing = onestore_get_theme_mod( $type . '_letter_spacing' );
			if ( ! empty( $letter_spacing ) ) {
				$css_array['global'][ $selector ]['letter-spacing'] = $letter_spacing;
			}
		}

		// Content wrapper width for content layout with sidebar
		// $css_array['global']['body.onestore-editor-left-sidebar']['width'] =
		// $css_array['global']['body.onestore-editor-right-sidebar']['width'] = 'calc(' . onestore_get_content_width_by_layout() . 'px + 2rem)';
		// // Content wrapper width for narrow content layout
		// $css_array['global']['body.onestore-editor-narrow']['width'] = 'calc(' . onestore_get_content_width_by_layout( 'narrow' ) . 'px + 2rem)';
		// // Content wrapper width for full content layout
		// $css_array['global']['body.onestore-editor-wide']['width'] = 'calc(' . onestore_get_content_width_by_layout( 'wide' ) . 'px + 2rem)';
		// Build CSS string.
		// $styles = str_replace( '"', '\"', onestore_convert_css_array_to_string( $css_array ) );
		$styles = wp_slash( onestore_convert_css_array_to_string( $css_array ) );

		// Merge with existing styles or add new styles.
		if ( ! isset( $settings['content_style'] ) ) {
			$settings['content_style'] = $styles . ' ';
		} else {
			$settings['content_style'] .= ' ' . $styles . ' ';
		}

		return $settings;
	}

	/**
	 * Add body class to classic editor.
	 *
	 * @param array $settings
	 * @return array
	 */
	public function add_classic_editor_body_class( $settings ) {
		// Skip Gutenberg editor page.
		$current_screen = get_current_screen();
		if ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {
			return $settings;
		}

		global $post;

		if ( empty( $post ) ) {
			return $settings;
		}

		$class = 'onestore-editor-' . onestore_get_page_setting_by_post_id( 'content_layout', $post->ID );

		// Merge with existing classes or add new class.
		if ( ! isset( $settings['body_class'] ) ) {
			$settings['body_class'] = $class . ' ';
		} else {
			$settings['body_class'] .= ' ' . $class . ' ';
		}

		return $settings;
	}

	/**
	 * Add custom CSS to Gutenberg editor.
	 *
	 * @param array $settings
	 * @return array
	 */
	public function add_gutenberg_custom_css( $settings ) {
		$css_array = array();

		// Content width.
		$css_array['global']['.wp-block[data-align="wide"]']['max-width'] = 'calc(' . onestore_get_theme_mod( 'container_width' ) . ' + ' . '30px)';
		$css_array['global']['.wp-block[data-align="full"]']['max-width'] = 'none';
		$css_array['global']['.editor-post-title__block .editor-post-title__input']['font-family'] = 'inherit';
		$css_array['global']['.editor-post-title__block .editor-post-title__input']['font-weight'] = 'inherit';
		$css_array['global']['.editor-post-title__block .editor-post-title__input']['font-style'] = 'inherit';
		$css_array['global']['.editor-post-title__block .editor-post-title__input']['text-transform'] = 'inherit';
		$css_array['global']['.editor-post-title__block .editor-post-title__input']['font-size'] = 'inherit';
		$css_array['global']['.editor-post-title__block .editor-post-title__input']['line-height'] = 'inherit';
		$css_array['global']['.editor-post-title__block .editor-post-title__input']['letter-spacing'] = 'inherit';

		// Typography.
		$active_google_fonts = array();
		$typography_types = array(
			'body' => 'body',
			'blockquote' => 'blockquote',
			'h1' => 'h1, .editor-post-title__block .editor-post-title__input',
			'h2' => 'h2',
			'h3' => 'h3',
			'h4' => 'h4',
			'title' => '.editor-post-title__block .editor-post-title__input',
		);
		$fonts = onestore_get_all_fonts();

		foreach ( $typography_types as $type => $selector ) {
			// Font Family
			$font_family = onestore_get_theme_mod( $type . '_font_family' );
			$font_stack = $font_family;
			if ( '' !== $font_family && 'inherit' !== $font_family ) {
				$chunks = explode( '|', $font_family );
				if ( 2 === count( $chunks ) ) {
					$font_stack = onestore_array_value( $fonts[ $chunks[0] ], $chunks[1], $chunks[1] );
				}
			}
			if ( ! empty( $font_stack ) ) {
				$css_array['global'][ $selector ]['font-family'] = $font_stack;
			}

			// Font weight
			$font_weight = onestore_get_theme_mod( $type . '_font_weight' );
			if ( ! empty( $font_weight ) ) {
				$css_array['global'][ $selector ]['font-weight'] = $font_weight;
			}

			// Font style
			$font_style = onestore_get_theme_mod( $type . '_font_style' );
			if ( ! empty( $font_style ) ) {
				$css_array['global'][ $selector ]['font-style'] = $font_style;
			}

			// Text transform
			$text_transform = onestore_get_theme_mod( $type . '_text_transform' );
			if ( ! empty( $text_transform ) ) {
				$css_array['global'][ $selector ]['text-transform'] = $text_transform;
			}

			// Font size
			$font_size = onestore_get_theme_mod( $type . '_font_size' );
			if ( ! empty( $font_size ) ) {
				$css_array['global'][ $selector ]['font-size'] = $font_size;
			}

			// Line height
			$line_height = onestore_get_theme_mod( $type . '_line_height' );
			if ( ! empty( $line_height ) ) {
				$css_array['global'][ $selector ]['line-height'] = $line_height;
			}

			// Letter spacing
			$letter_spacing = onestore_get_theme_mod( $type . '_letter_spacing' );
			if ( ! empty( $letter_spacing ) ) {
				$css_array['global'][ $selector ]['letter-spacing'] = $letter_spacing;
			}
		}

		// Relative heading margin top
		$css_array['global']['h1, h2, h3, h4, h5, h6']['margin-top'] = 'calc( 2 * ' . onestore_get_theme_mod( 'body_font_size' ) . ') !important';

		// Add to settings array.
		$settings['styles']['onestore-custom'] = array(
			'css' => onestore_convert_css_array_to_string( $css_array ),
		);

		return $settings;
	}

	/**
	 * ====================================================
	 * AJAX functions
	 * ====================================================
	 */

	/**
	 * AJAX callback to dismiss rating notice.
	 */
	public function ajax_dismiss_rating_notice() {
		$repeat_after = ( isset( $_REQUEST['repeat_after'] ) ) ? intval( $_REQUEST['repeat_after'] ) : false;

		if ( -1 == $repeat_after ) {
			// Dismiss rating notice forever.
			update_option( 'onestore_rating_notice_is_dismissed', 1 );
		} else {
			// Repeat rating notice later.
			update_option( 'onestore_installed_time', time() );
		}

		wp_send_json_success();
	}

	/**
	 * AJAX callback to install OneStore Sites Import plugin.
	 */
	public function ajax_install_sites_import_plugin() {
		check_ajax_referer( 'onestore', '_ajax_nonce' );

		if ( ! current_user_can( 'install_plugins' ) ) {
			wp_send_json_error();
		}

		$path = 'onestore-sites-import/onestore-sites-import.php';

		if ( ! file_exists( WP_PLUGIN_DIR . '/' . $path ) ) {
			if ( ! function_exists( 'plugins_api' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
			}
			if ( ! class_exists( 'WP_Upgrader' ) ) {
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			}

			$api = plugins_api(
				'plugin_information',
				array(
					'slug' => 'onestore-sites',
					'fields' => array(
						'short_description' => false,
						'sections' => false,
						'requires' => false,
						'rating' => false,
						'ratings' => false,
						'downloaded' => false,
						'last_updated' => false,
						'added' => false,
						'tags' => false,
						'compatibility' => false,
						'homepage' => false,
						'donate_link' => false,
					),
				)
			);

			// Use AJAX upgrader skin instead of plugin installer skin.
			// ref: function wp_ajax_install_plugin().
			$upgrader = new Plugin_Upgrader( new WP_Ajax_Upgrader_Skin() );

			$install = $upgrader->install( $api->download_link );

			if ( false === $install ) {
				wp_send_json_error();
			}
		}

		if ( ! is_plugin_active( $path ) ) {
			$activate = activate_plugin( $path, '', false, true );

			if ( is_wp_error( $activate ) ) {
				wp_send_json_error();
			}
		}

		wp_send_json_success();
	}

	/**
	 * ====================================================
	 * Render functions
	 * ====================================================
	 */

	/**
	 * Render admin page.
	 */
	public function render_admin_page() {
		?>
		<div class="wrap onestore-admin-wrap <?php echo esc_attr( onestore_is_plus() ? 'onestore-pro-installed' : '' ); ?>">
			<div class="onestore-admin-header">
				<div class="onestore-admin-wrapper wp-clearfix">
					<?php
					/**
					 * Hook: onestore/admin/dashboard/header
					 */
					do_action( 'onestore/admin/dashboard/header' );
					?>
				</div>
			</div>

			<div class="onestore-admin-notices">
				<div class="onestore-admin-wrapper">
					<h1 style="display: none;"></h1>

					<?php settings_errors(); ?>
				</div>
			</div>

			<div class="onestore-admin-content metabox-holder">
				<div class="onestore-admin-wrapper">
					<div class="onestore-admin-content-row">
						<div class="onestore-admin-primary">
							<?php
							/**
							 * Hook: onestore/admin/dashboard/content
							 */
							do_action( 'onestore/admin/dashboard/content' );
							?>
						</div>

						<?php if ( has_action( 'onestore/admin/dashboard/sidebar' ) ) : ?>
							<div class="onestore-admin-secondary">
								<?php
								/**
								 * Hook: onestore/admin/dashboard/sidebar
								 */
								do_action( 'onestore/admin/dashboard/sidebar' );
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render logo on OneStore admin page.
	 */
	public function render_admin_page__logo() {
		?>
		<div class="onestore-admin-logo">
			<?php echo apply_filters( 'onestore/admin/dashboard/logo', '<img src="' . esc_url( ONESTORE_IMAGES_URL . '/logo.png' ) . '" alt="' . esc_attr( get_admin_page_title() ) . '">' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<span class="onestore-admin-version"><?php echo onestore_get_theme_info( 'version' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</div>
		<?php
	}

	/**
	 * Render modules manager on OneStore admin page.
	 */
	public function render_admin_page__modules() {
		$all_modules = array();
		$module_categories = onestore_get_module_categories();

		// Fetch free modules.
		foreach ( onestore_get_theme_modules() as $module_slug => $module_data ) {
			$data = wp_parse_args(
				$module_data,
				array(
					'label'    => '',
					'url'      => '',
					'category' => '',
					'actions'  => array(),
					'hide'     => false,
					'pro'      => false,
					'active'   => true,
				)
			);

			// Always flag all free modules as FREE.
			$data['pro'] = false;

			// Always make sure all free modules are active.
			$data['active'] = true;

			// Add action.
			$data['actions']['enabled'] = array(
				'label' => '✓',
			);

			// Add to collection.
			if ( ! empty( $data['category'] ) ) {
				$all_modules[ $data['category'] ][ $module_slug ] = $data;
			}
		}

		// Fetch pro modules.
		foreach ( onestore_get_pro_modules() as $module_slug => $module_data ) {
			$data = wp_parse_args(
				$module_data,
				array(
					'label'    => '',
					'url'      => '',
					'category' => '',
					'actions'  => array(),
					'hide'     => false,
					'pro'      => true,
					'active'   => false,
				)
			);

			// Always flag all free modules as PRO.
			$data['pro'] = true;

			// Add to collection.
			if ( ! empty( $data['category'] ) ) {
				$all_modules[ $data['category'] ][ $module_slug ] = $data;
			}
		}

		?>
		<div class="onestore-admin-modules postbox" action="" method="POST">
			<h2 class="hndle">
				<?php echo wp_kses_post( apply_filters( 'onestore/pro/modules/list_heading', esc_html__( 'Modules Manager', 'onestore' ) ) ); ?>
			</h2>
			<div class="inside">
				<?php foreach ( $all_modules as $category_slug => $category_modules ) : ?>
					<?php
					// Skip if specified category doesn't exists.
					if ( ! isset( $module_categories[ $category_slug ] ) ) {
						continue;
					}
					?>
					<h3 class="onestore-admin-modules-category <?php echo esc_attr( 'onestore-admin-modules-category--' . $category_slug ); ?>"><?php echo esc_html( $module_categories[ $category_slug ] ); ?></h3>
					<ul class="onestore-admin-modules-grid">
						<?php foreach ( $category_modules as $module_slug => $module_data ) : ?>
							<?php
							// Skip if module is in "hide" mode.
							if ( intval( $module_data['hide'] ) ) {
								continue;
							}

							// Add note all pro modules "Available on OneStore Pro".
							if ( $module_data['pro'] && ! onestore_is_plus() ) {
								$module_data['actions'] = array(
									'available-on-onestore-pro' => array(
										'label' => esc_html__( 'Available on OneStore Pro', 'onestore' ),
									),
								);

								$module_data['active'] = false;
							}

							// Check WooCommerce modules.
							if ( 'woocommerce' === $category_slug && ! class_exists( 'WooCommerce' ) ) {
								$module_data['actions'] = array(
									'woocommerce-not-found' => array(
										'label' => esc_html__( 'WooCommerce is not installed', 'onestore' ),
									),
								);

								$module_data['active'] = false;
							}
							?>
							<li id="<?php echo esc_attr( 'onestore-admin-module--' . $module_slug ); ?>" class="onestore-admin-module <?php echo esc_attr( ( $module_data['pro'] ? 'pro' : 'free' ) . ' ' . ( $module_data['active'] ? 'active' : 'inactive' ) ); ?>">
								<h4 class="onestore-admin-module-name">
									<?php if ( ! empty( $module_data['url'] ) ) : ?>
										<a href="<?php echo esc_html( $module_data['url'] ); ?>" target="_blank" rel="noopener">
											<span><?php echo esc_html( $module_data['label'] ); ?></span>
										</a>
									<?php else : ?>
										<span><?php echo esc_html( $module_data['label'] ); ?></span>
									<?php endif; ?>

									<?php if ( $module_data['pro'] ) : ?>
										<span class="onestore-admin-module-badge-pro"><?php esc_html_e( 'Pro', 'onestore' ); ?></span>
									<?php endif; ?>
								</h4>

								<div class="onestore-admin-module-actions row-actions">
									<?php foreach ( $module_data['actions'] as $action_key => $action_data ) : ?>
										<span class="<?php echo esc_attr( 'onestore-admin-module-action--' . $action_key ); ?>">
											<?php if ( isset( $action_data['url'] ) ) : ?>
												<a href="<?php echo esc_url( $action_data['url'] ); ?>"><?php echo esc_html( $action_data['label'] ); ?></a>
											<?php else : ?>
												<span><?php echo esc_html( $action_data['label'] ); ?></span>
											<?php endif; ?>
										</span>
									<?php endforeach; ?>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render links box on OneStore admin page's sidebar.
	 */
	public function render_sidebar__links() {
		$menus = apply_filters(
			'onestore/admin/dashboard/menu',
			array(
				array(
					'label'  => esc_html__( 'OneStore Website', 'onestore' ),
					'url'    => 'https://sainwp.com/',
					'icon'   => 'dashicons-admin-home',
					'newtab' => true,
				),
				array(
					'label'  => esc_html__( 'Documentation', 'onestore' ),
					'url'    => 'https://sainwp.com/docs/',
					'icon'   => 'dashicons-book-alt',
					'newtab' => true,
				),
				array(
					'label'  => esc_html__( 'Users Community Group', 'onestore' ),
					'url'    => 'https://www.facebook.com/groups/onestorewp',
					'icon'   => 'dashicons-groups',
					'newtab' => true,
				),
				array(
					'label'  => esc_html__( 'Follow Us on Facebook', 'onestore' ),
					'url'    => 'https://www.facebook.com/OneStore-WordPress-Theme-109438244629500',
					'icon'   => 'dashicons-facebook',
					'newtab' => true,
				),
				array(
					'label'  => esc_html__( 'Rate Us &#9733;&#9733;&#9733;&#9733;&#9733;', 'onestore' ),
					'url'    => 'https://wordpress.org/support/theme/onestore/reviews/?rate=5#new-post',
					'icon'   => 'dashicons-star-filled',
					'newtab' => true,
				),
			)
		);
		?>
		<div class="onestore-admin-other-links postbox">
			<h2 class="hndle"><?php esc_html_e( 'Other Links', 'onestore' ); ?></h2>
			<div class="inside">
				<ul class="onestore-admin-links-list">
					<?php foreach ( $menus as $menu ) : ?>
						<li><span class="dashicons <?php echo esc_attr( $menu['icon'] ); ?>"></span><a href="<?php echo esc_url( $menu['url'] ); ?>" <?php echo $menu['newtab'] ? ' target="_blank" rel="noopener"' : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $menu['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php
	}

	/**
	 * Render "One Click Demo Import" info box on OneStore admin page's sidebar.
	 */
	public function render_sidebar__sites() {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}
		?>
		<div class="onestore-admin-demo-sites postbox">
			<h2 class="hndle"><?php esc_html_e( 'One Click Demo Import', 'onestore' ); ?></h2>
			<div class="inside">
				<p class="onestore-admin-demo-sites-image"><img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>" width="300" height="auto"></p>
				<p><?php esc_html_e( 'Kickstart your website with our pre-made demo websites in 3 steps: Import. Modify. Launch!', 'onestore' ); ?></p>
				<p>
					<?php if ( is_plugin_active( 'onestore-sites-import/onestore-sites-import.php' ) ) : ?>
						<a href="<?php echo esc_url( add_query_arg( array( 'page' => 'onestore-sites-import' ), admin_url( 'themes.php' ) ) ); ?>" class="button button-large button-secondary"><?php esc_html_e( 'Browse Demo Sites', 'onestore' ); ?></a>
					<?php else : ?>
						<button class="onestore-admin-install-sites-import-plugin-button button button-large button-secondary"><?php esc_html_e( 'Install & Activate Plugin', 'onestore' ); ?></button>
					<?php endif; ?>
				</p>
			</div>
		</div>
		<?php
	}
}

OneStore_Admin::instance();
