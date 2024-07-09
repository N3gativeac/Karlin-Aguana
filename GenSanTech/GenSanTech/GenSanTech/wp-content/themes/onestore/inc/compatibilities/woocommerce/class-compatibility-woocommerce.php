<?php
/**
 * Plugin compatibility: WooCommerce
 *
 * @package OneStore
 */
use Automattic\Jetpack\Constants;
// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class OneStore_Compatibility_WooCommerce {

	/**
	 * Singleton instance
	 *
	 * @var OneStore_Compatibility_WooCommerce
	 */
	private static $instance;
	private $is_quick_view = false;

	/**
	 * ====================================================
	 * Singleton & constructor functions
	 * ====================================================
	 */

	/**
	 * Get singleton instance.
	 *
	 * @return OneStore_Compatibility_WooCommerce
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
		// Theme supports
		add_action( 'after_setup_theme', array( $this, 'add_theme_supports' ) );

		// Compatibility CSS
		add_filter( 'woocommerce_enqueue_styles', array( $this, 'disable_original_css' ) );
		add_action( 'onestore/frontend/after_enqueue_main_css', array( $this, 'enqueue_css' ) );
		add_filter( 'onestore/frontend/woocommerce/dynamic_css', array( $this, 'add_dynamic_css' ) );

		// Customizer settings & values.
		add_action( 'customize_register', array( $this, 'register_customizer_settings' ) );
		add_filter( 'onestore/customizer/item_block_builders', array( $this, 'add_item_block_builder' ), 20 );
		add_filter( 'onestore/customizer/setting_postmessages', array( $this, 'add_customizer_setting_postmessages' ) );

		// Template hooks.
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
		add_action( 'init', array( $this, 'modify_template_hooks' ) );
		add_action( 'wp', array( $this, 'modify_template_hooks_after_init' ) );

		// Page settings.
		add_action( 'onestore/admin/metabox/page_settings/disabled_posts', array( $this, 'exclude_shop_page_from_page_settings' ), 10, 2 );

		add_filter( 'onestore/admin/metabox/page_settings/tabs', array( $this, 'add_page_settings_tab__product' ) );
		add_action( 'onestore/admin/metabox/page_settings/fields', array( $this, 'render_page_settings_fields__product' ), 10, 2 );
		add_filter( 'onestore/dataset/fallback_page_settings', array( $this, 'add_page_settings_fallback_values__product' ) );

		add_action( 'wp_footer', array( $this, 'quickview_template' ), 199 );

		if ( isset( $_GET['onestore_quick_view'] ) && absint( $_GET['onestore_quick_view'] ) == 1 ) {
			$this->is_quick_view = true;
			add_filter( 'onestore/frontend/show_header_all', '__return_false', 900 );
			add_filter( 'onestore/frontend/show_footer_all', '__return_false', 900 );
			add_filter( 'onestore/single_product_show_after_summary', '__return_false', 900 );
		}
		add_action( 'onestore/frontend/localize_script', array( $this, 'localize_script' ), 199 );

	}

	public function action_filter() {
		if ( is_shop() || is_product_category() || is_product_category() || is_product_tag() ) {
			$active_filter = $this->filter_results();
			onestore_get_template_part( 'wc-filter', false, array( 'active_filter' => $active_filter ) );

			ob_start();
			echo '<div id="shop-filter" class="widget-area">';
			dynamic_sidebar( 'sidebar-shop-filter' );
			echo '</div>';
			$this->filter_sidebar_content = ob_get_clean();
		}

	}

	public function filter_sidebar() {
		if ( $this->filter_sidebar_content ) {
			onestore_popup( 'product-filter-modal', esc_html__( 'Filters', 'onestore' ), $this->filter_sidebar_content, 'right' );
		}

	}

	/**
	 * Get current page URL with various filtering props supported by WC.
	 *
	 * @return string
	 * @since  3.3.0
	 */
	public function get_current_page_url() {
		if ( Constants::is_defined( 'SHOP_IS_ON_FRONT' ) ) {
			$link = home_url();
		} elseif ( is_shop() ) {
			$link = get_permalink( wc_get_page_id( 'shop' ) );
		} elseif ( is_product_category() ) {
			$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
		} elseif ( is_product_tag() ) {
			$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
		} else {
			$queried_object = get_queried_object();
			$link           = get_term_link( $queried_object->slug, $queried_object->taxonomy );
		}

		// Min/Max.
		if ( isset( $_GET['min_price'] ) ) {
			$link = add_query_arg( 'min_price', wc_clean( wp_unslash( $_GET['min_price'] ) ), $link );
		}

		if ( isset( $_GET['max_price'] ) ) {
			$link = add_query_arg( 'max_price', wc_clean( wp_unslash( $_GET['max_price'] ) ), $link );
		}

		// Order by.
		if ( isset( $_GET['orderby'] ) ) {
			$link = add_query_arg( 'orderby', wc_clean( wp_unslash( $_GET['orderby'] ) ), $link );
		}

		/**
		 * Search Arg.
		 * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
		 */
		if ( get_search_query() ) {
			$link = add_query_arg( 's', rawurlencode( htmlspecialchars_decode( get_search_query() ) ), $link );
		}

		// Post Type Arg.
		if ( isset( $_GET['post_type'] ) ) {
			$link = add_query_arg( 'post_type', wc_clean( wp_unslash( $_GET['post_type'] ) ), $link );

			// Prevent post type and page id when pretty permalinks are disabled.
			if ( is_shop() ) {
				$link = remove_query_arg( 'page_id', $link );
			}
		}

		// Min Rating Arg.
		if ( isset( $_GET['rating_filter'] ) ) {
			$link = add_query_arg( 'rating_filter', wc_clean( wp_unslash( $_GET['rating_filter'] ) ), $link );
		}

		// All current filters.
		if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found, WordPress.CodeAnalysis.AssignmentInCondition.Found
			foreach ( $_chosen_attributes as $name => $data ) {
				$filter_name = wc_attribute_taxonomy_slug( $name );
				if ( ! empty( $data['terms'] ) ) {
					$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
				}
				if ( 'or' === $data['query_type'] ) {
					$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
				}
			}
		}

		return apply_filters( 'woocommerce_widget_get_current_page_url', $link, $this );
	}

	/**
	 * Just a copied from /plugins/woocommerce/includes/widgets/class-wc-widget-layered-nav-filters.php
	 *
	 * @return void
	 */
	public function filter_results() {
		$_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
		$min_price          = isset( $_GET['min_price'] ) ? wc_clean( wp_unslash( $_GET['min_price'] ) ) : 0; // WPCS: input var ok, CSRF ok.
		$max_price          = isset( $_GET['max_price'] ) ? wc_clean( wp_unslash( $_GET['max_price'] ) ) : 0; // WPCS: input var ok, CSRF ok.
		$rating_filter      = isset( $_GET['rating_filter'] ) ? array_filter( array_map( 'absint', explode( ',', wp_unslash( $_GET['rating_filter'] ) ) ) ) : array(); // WPCS: sanitization ok, input var ok, CSRF ok.
		$base_link          = $this->get_current_page_url();

		$html = '';
		// Attributes.
		if ( ! empty( $_chosen_attributes ) ) {
			foreach ( $_chosen_attributes as $taxonomy => $data ) {
				$name = wc_attribute_label( $taxonomy );
				$list = array();
				foreach ( $data['terms'] as $term_slug ) {
					$term = get_term_by( 'slug', $term_slug, $taxonomy );

					if ( ! $term ) {
						continue;
					}

					$filter_name    = 'filter_' . wc_attribute_taxonomy_slug( $taxonomy );
					$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( wp_unslash( $_GET[ $filter_name ] ) ) ) : array(); // WPCS: input var ok, CSRF ok.
					$current_filter = array_map( 'sanitize_title', $current_filter );
					$new_filter     = array_diff( $current_filter, array( $term_slug ) );

					$link = remove_query_arg( array( 'add-to-cart', $filter_name ), $base_link );

					if ( count( $new_filter ) > 0 ) {
						$link = add_query_arg( $filter_name, implode( ',', $new_filter ), $link );
					}

					$filter_classes = array( 'chosen', 'chosen-' . sanitize_html_class( str_replace( 'pa_', '', $taxonomy ) ), 'chosen-' . sanitize_html_class( str_replace( 'pa_', '', $taxonomy ) . '-' . $term_slug ) );

					$list[] = '<li class="' . esc_attr( implode( ' ', $filter_classes ) ) . '"><a rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'onestore' ) . '" href="' . esc_url( $link ) . '">' . esc_html( $term->name ) . '</a></li>';
				}

				if ( count( $list ) > 0 ) {
					$html .= '<div class="filter-group"><span class="filter-tax-name">' . esc_html( $name ) . ':</span><ul>' . join( ' ', $list ) . '</ul></div>';
				}
			}
		}
		return $html;
	}

	/**
	 * Add opening products filters wrapper tag.
	 */
	public function before_shop_loop() {
		if ( has_action( 'onestore/wc/before_shop_loop' ) ) {
			?><div class="onestore-products-filters">
			<?php do_action( 'onestore/wc/before_shop_loop' ); ?>
		</div><?php
		}
	}

	public function localize_script( $args ) {
		if ( $this->is_quick_view ) {
			$args['is_quick_view'] = true;
		}
		return $args;
	}

	public function quickview_template() {
		if ( ! function_exists( 'wc' ) ) {
			return;
		}
		if ( $this->is_quick_view ) {
			return;
		}
		echo '<script id="onestore-quick-view-tpl" type="text/html">';
		onestore_popup( 'onestore-qv-modal-tpl-id', '', '', 'center' );
		echo '</script>';

	}

	public function add_item_block_builder( $items ) {
		$blocks = array(
			'wc_title'      => esc_html__( 'Title', 'onestore' ),
			'wc_price'      => esc_html__( 'Price', 'onestore' ),
			'wc_price_less' => esc_html__( 'Price Less', 'onestore' ),
			'wc_rating'      => esc_html__( 'Rating', 'onestore' ),
			'wc_sale'      => esc_html__( 'Sale', 'onestore' ),
			'wc_sale_percent'      => esc_html__( 'Sale Percentage', 'onestore' ),
			'wc_category'    => esc_html__( 'Category', 'onestore' ),
			'wc_add_to_cart' => esc_html__( 'Add to cart', 'onestore' ),
			'wc_add_to_cart_icon' => esc_html__( 'Add to cart icon', 'onestore' ),
			'wc_wishlist_icon' => esc_html__( 'Wishlist Icon', 'onestore' ),
			'wc_quick_view_icon' => esc_html__( 'Quick View Icon', 'onestore' ),
		);

		if ( defined( 'SAVP__PATH' ) ) {
			$blocks['wc_swatches'] = esc_html__( 'Swatches', 'onestore' );
		}

		$items['wc'] = array(
			'setting_key' => 'woocommerce_index_item_elements',
			'section' => 'woocommerce_product_catalog',
			'start_priority' => 70,
			'items' => $blocks,
		);

		return $items;
	}

	/**
	 * ====================================================
	 * Hook functions
	 * ====================================================
	 */

	/**
	 * Define WooCommerce theme's supports.
	 */
	public function add_theme_supports() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );
		add_theme_support( 'wc-product-gallery-lightbox' );
	}

	/**
	 * Enqueue compatibility CSS.
	 */
	public function enqueue_css() {
		wp_enqueue_style( 'onestore-woocommerce', ONESTORE_CSS_URL . '/compatibilities/woocommerce/woocommerce' . ONESTORE_ASSETS_SUFFIX . '.css', array(), ONESTORE_VERSION );
		wp_style_add_data( 'onestore-woocommerce', 'rtl', 'replace' );

		// Inline CSS.
		wp_add_inline_style( 'onestore-woocommerce', trim( apply_filters( 'onestore/frontend/woocommerce/dynamic_css', '' ) ) );
	}

	/**
	 * Disable original WooCommerce CSS.
	 *
	 * @param array $styles
	 * @return array
	 */
	public function disable_original_css( $styles ) {
		$styles['woocommerce-layout']['src'] = false;
		$styles['woocommerce-smallscreen']['src'] = false;
		$styles['woocommerce-general']['src'] = false;

		return $styles;
	}

	/**
	 * Add dynamic CSS from customizer settings into the inline CSS.
	 *
	 * @param string $css
	 * @return string
	 */
	public function add_dynamic_css( $css ) {
		// Skip adding dynamic CSS on customizer preview frame.
		if ( is_customize_preview() ) {
			return $css;
		}

		$postmessages = include ONESTORE_INCLUDES_DIR . '/compatibilities/woocommerce/customizer/postmessages.php';
		$generated_css = OneStore_Customizer::instance()->convert_postmessages_to_css_string( $postmessages, array() );
		if ( ! empty( $generated_css ) ) {
			$css .= "\n/* OneStore + WooCommerce Dynamic CSS */\n" . $generated_css;
		}

		return $css;
	}

	/**
	 * Register customizer sections, settings, and controls.
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	public function register_customizer_settings( $wp_customize ) {
		$defaults = OneStore_Customizer::instance()->get_setting_defaults();

		require_once ONESTORE_INCLUDES_DIR . '/compatibilities/woocommerce/customizer/options/_sections.php';
		require_once ONESTORE_INCLUDES_DIR . '/compatibilities/woocommerce/customizer/options/woocommerce--store-notice.php';
		require_once ONESTORE_INCLUDES_DIR . '/compatibilities/woocommerce/customizer/options/woocommerce--product-catalog.php';
		require_once ONESTORE_INCLUDES_DIR . '/compatibilities/woocommerce/customizer/options/woocommerce--product-single.php';
		require_once ONESTORE_INCLUDES_DIR . '/compatibilities/woocommerce/customizer/options/woocommerce--cart.php';
		require_once ONESTORE_INCLUDES_DIR . '/compatibilities/woocommerce/customizer/options/woocommerce--checkout.php';
		require_once ONESTORE_INCLUDES_DIR . '/compatibilities/woocommerce/customizer/options/woocommerce--other-elements.php';
	}



	/**
	 * Add postmessage rules for some Customizer settings.
	 *
	 * @param array $postmessages
	 * @return array
	 */
	public function add_customizer_setting_postmessages( $postmessages = array() ) {
		$add = include ONESTORE_INCLUDES_DIR . '/compatibilities/woocommerce/customizer/postmessages.php';
		return array_merge_recursive( $postmessages, $add );
	}

	/**
	 * Register additional sidebar for WooCommerce.
	 */
	public function register_sidebars() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar Shop', 'onestore' ),
				'id'            => 'sidebar-shop',
				'description'   => esc_html__( 'Sidebar that replaces the default sidebar when on WooCommerce pages.', 'onestore' ),
				'before_widget' => '<div id="%1$s" class="widget onestore-wc-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar Shop Filter', 'onestore' ),
				'id'            => 'sidebar-shop-filter',
				'description'   => esc_html__( 'Sidebar that replaces the default sidebar when on WooCommerce pages.', 'onestore' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

	}

	public static function cart_sticky() {
		if ( is_singular( 'product' ) ) {
			$position = onestore_get_theme_mod( 'woocommerce_single_sticky_cart', 'top' );
			if ( 'top' == $position || 'bottom' == $position ) {
				onestore_get_template_part( 'cart-sticky' );
			}
		}

	}

	/**
	 * Modify filters for WooCommerce template rendering.
	 */
	public function modify_template_hooks() {
		/**
		 * Global template hooks
		 */

		// Sticky cart.
		add_action( 'onestore/frontend/before_canvas', [ __CLASS__, 'cart_sticky' ], 50 );

		// Change main content (primary) wrapper.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', 'onestore_primary_open' );
		add_action( 'woocommerce_after_main_content', 'onestore_primary_close' );

		// Add count to Cart menu item.
		add_filter( 'nav_menu_item_title', array( $this, 'add_count_to_cart_menu_item' ), 10, 4 );

		// Add filter for adding class to products grid wrapper.
		add_filter( 'woocommerce_product_loop_start', array( $this, 'change_loop_start_markup' ) );

		// Change mobile devices breakpoint.
		add_filter( 'woocommerce_style_smallscreen_breakpoint', array( $this, 'set_smallscreen_breakpoint' ) );

		// Add cart fragments.
		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'update_header_cart' ) );

		// Modify "added to cart" message.
		add_filter( 'wc_add_to_cart_message_html', array( $this, 'change_add_to_cart_message_html' ), 10, 3 );

		// Modify flexslider settings on single product page.
		add_filter( 'woocommerce_single_product_carousel_options', array( $this, 'change_single_product_carousel_options' ), 10, 3 );

		// Add plus and minus buttons to the quantity input.
		add_action( 'woocommerce_after_quantity_input_field', array( $this, 'add_quantity_plus_minus_buttons' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_quantity_plus_minus_buttons_scripts' ) );

		/**
		 * Shop page's template hooks
		 */
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

		// Add wrapper to products grid item.
		add_action( 'woocommerce_before_shop_loop_item', array( $this, 'render_loop_item_wrapper' ), 1 );
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'render_loop_item_wrapper_end' ), 999 );

		// Reposition sale badge on products grid item.
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 2 );

		// Reposition product image and wrap it with custom <div>.
		if ( defined( 'ONESTORE_PRO_VERSION' ) && version_compare( preg_replace( '/\-.*/', '', ONESTORE_PRO_VERSION ), '1.1.0', '<' ) ) {
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			add_action( 'woocommerce_before_shop_loop_item', array( $this, 'render_loop_product_thumbnail_wrapper' ), 2 );
			add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 5 );
			add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 10 );
			add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_close', 15 );
			add_action( 'woocommerce_before_shop_loop_item', array( $this, 'render_loop_product_thumbnail_wrapper_end' ), 20 );
		} else {
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'render_loop_product_thumbnail_wrapper' ), 1 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 19 );
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'render_loop_product_thumbnail_wrapper_end' ), 999 );
		}

		// Wrap the title with link.
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 1 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 999 );

		// Products loop.
		add_filter( 'loop_shop_per_page', array( $this, 'set_loop_posts_per_page' ) );

		/**
		 * Product page's template hooks
		 */

		// hide tab desc.
		add_filter( 'woocommerce_product_description_heading', '__return_false', 50 );
		add_filter( 'woocommerce_product_additional_information_heading', '__return_false', 50 );

		// Add a new filter to add additional classes to single product wrapper.
		add_action( 'woocommerce_before_single_product', array( $this, 'add_single_product_class' ) );

		// Add class to single product gallery for single image or multiple images.
		add_filter( 'woocommerce_single_product_image_gallery_classes', array( $this, 'add_single_product_gallery_class' ) );

		// Move sale badge.
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
		add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 21 );

		// Set product images thumbnails columns.
		add_filter( 'woocommerce_product_thumbnails_columns', array( $this, 'set_product_thumbnails_columns' ) );

		// Add wrapper to single product add to cart form.
		add_filter( 'woocommerce_before_add_to_cart_form', array( $this, 'render_add_to_cart_form_wrapper' ) );
		add_filter( 'woocommerce_after_add_to_cart_form', array( $this, 'render_add_to_cart_form_wrapper_end' ) );

		// Related products.
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'set_related_products_display_args' ) );

		// Up sells.
		add_filter( 'woocommerce_upsell_display_args', array( $this, 'set_up_sells_display_args' ) );

		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		add_action( 'woocommerce_after_single_product_summary', [ __CLASS__, 'action_more_single_sections' ], 50 );

		/**
		 * Cart page's template hooks
		 */

		// Cross sells columns.
		add_filter( 'woocommerce_cross_sells_columns', array( $this, 'set_cart_page_cross_sells_columns' ) );

		/**
		 * My Account page's template hooks
		 */

		// Add account avatar and name into side navigation.
		add_filter( 'woocommerce_before_account_navigation', array( $this, 'render_account_sidebar_wrapper' ), 1 );
		add_filter( 'woocommerce_after_account_navigation', array( $this, 'render_account_sidebar_wrapper_end' ), 999 );

		add_filter( 'woocommerce_after_add_to_cart_button', array( $this, 'add_single_wishlist_button' ), 999 );

		// Filter.
		add_action( 'onestore/wc/before_shop_loop', 'woocommerce_catalog_ordering', 15 );
		add_action( 'onestore/wc/before_shop_loop', [ $this, 'filter_button' ], 12 );

		// Add wrapper to products grid filters.
		if ( onestore_get_theme_mod( 'woocommerce_ajax_filter' ) ) {
			add_action( 'woocommerce_before_shop_loop', array( $this, 'before_shop_loop' ), 11 );
			add_action( 'woocommerce_before_shop_loop', [ $this, 'action_filter' ], 680 );
			add_action( 'onestore_wc_list_end', [ $this, 'filter_sidebar' ], 680 );
		}

	}

	public function filter_button() {
		?>
		<span class="filter-btn">
			<button data-target="product-filter-modal" class="action-toggle has-txt popup-toggle"><?php onestore_icon( 'filter' ); ?> <?php _e( 'Filter', 'onestore' ); ?></button>
		</span>
		<?php
	}

	public function add_single_wishlist_button() {
		if ( ! defined( 'YITH_WCWL' ) ) {
			return false;
		}
		$show = onestore_get_theme_mod( 'woocommerce_single_wishlist' );
		if ( $show ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist link_classes="wishlist-button" label="" product_added_text="" already_in_wishslist_text="" browse_wishlist_text=""]' ); // WPCS: XSS ok.
		}
	}

	public static function action_more_single_sections() {
		$sections = onestore_get_theme_mod( 'woocommerce_single_more_sections' );
		foreach ( (array) $sections as $section ) {
			switch ( $section ) {
				case 'up-sells':
					woocommerce_upsell_display();
					break;
				case 'related':
					woocommerce_output_related_products();
					break;
				default:
					do_action( 'onestore/woocommerce/more_single_section', $section );
			}
		}

	}

	/**
	 * Modify filters for WooCommerce template rendering based on Customizer settings.
	 */
	public function modify_template_hooks_after_init() {
		/**
		 * Global template hooks
		 */

		// Keep / remove gallery zoom module.
		if ( ! intval( onestore_get_theme_mod( 'woocommerce_single_gallery_zoom' ) ) ) {
			remove_theme_support( 'wc-product-gallery-zoom' );
		}

		// Keep / remove gallery lightbox module.
		if ( ! intval( onestore_get_theme_mod( 'woocommerce_single_gallery_lightbox' ) ) ) {
			remove_theme_support( 'wc-product-gallery-lightbox' );
		}

		/**
		 * Shop page's template hooks
		 */

		if ( is_shop() || is_product_taxonomy() ) {
			// Keep / remove page title.
			if ( ! intval( onestore_get_theme_mod( 'woocommerce_index_page_title' ) ) ) {
				add_filter( 'woocommerce_show_page_title', '__return_false' );
			}

			// Remove default hooks.
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

			// Keep / remove products sorting filter.
			if ( ! intval( onestore_get_theme_mod( 'woocommerce_index_sort_filter' ) ) ) {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			}
		}

		/**
		 * Products page's template hooks
		 */

		if ( is_product() ) {
			// Remove breadcrumb.
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

			// Keep / remove gallery.
			if ( ! intval( onestore_get_current_page_setting( 'woocommerce_single_gallery' ) ) ) {
				remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
			}

			// Keep / remove tabs.
			if ( ! intval( onestore_get_current_page_setting( 'woocommerce_single_tabs' ) ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			}

			// Keep / remove up-sells.
			if ( ! intval( onestore_get_current_page_setting( 'woocommerce_single_up_sells' ) ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			}

			// Keep / remove up-sells.
			if ( ! intval( onestore_get_current_page_setting( 'woocommerce_single_related' ) ) ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}
		}

		/**
		 * Cart page's template hooks.
		 */

		if ( is_cart() ) {
			// Split into 2 columns.
			if ( '2-columns' === onestore_get_theme_mod( 'woocommerce_cart_layout' ) ) {
				add_filter( 'body_class', array( $this, 'add_cart_two_columns_class' ) );

				remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
				add_action( 'woocommerce_before_cart_collaterals', 'woocommerce_cross_sell_display', 20 );

				add_action( 'woocommerce_before_cart', array( $this, 'render_cart_2_columns_left_wrapper' ), 999 );
				add_action( 'woocommerce_before_cart_collaterals', array( $this, 'render_cart_2_columns_left_wrapper_end' ), 999 );

				add_action( 'woocommerce_before_cart_collaterals', array( $this, 'render_cart_2_columns_right_wrapper' ), 999 );
				add_action( 'woocommerce_after_cart', array( $this, 'render_cart_2_columns_right_wrapper_end' ), 999 );
			}

			// Keep / remove cross-sells.
			if ( ! intval( onestore_get_theme_mod( 'woocommerce_cart_cross_sells' ) ) ) {
				remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
				remove_action( 'woocommerce_before_cart_collaterals', 'woocommerce_cross_sell_display', 20 ); // If 2 columns layout is enabled.
			}
		}

		/**
		 * Checkout page's template hooks
		 */

		if ( is_checkout() ) {
			// Split into 2 columns.
			if ( '2-columns' === onestore_get_theme_mod( 'woocommerce_checkout_layout' ) ) {
				add_filter( 'body_class', array( $this, 'add_checkout_two_columns_class' ) );

				add_action( 'woocommerce_checkout_before_customer_details', array( $this, 'render_checkout_2_columns_left_wrapper' ), 1 );
				add_action( 'woocommerce_checkout_after_customer_details', array( $this, 'render_checkout_2_columns_left_wrapper_end' ), 999 );

				add_action( 'woocommerce_checkout_before_order_review_heading', array( $this, 'render_checkout_2_columns_right_wrapper' ), 1 );
				add_action( 'woocommerce_checkout_after_order_review', array( $this, 'render_checkout_2_columns_right_wrapper_end' ), 999 );
			}
		}
	}

	/**
	 * Modify page settings metabox.
	 *
	 * @param array $ids
	 * @param array $post
	 * @return array
	 */
	public function exclude_shop_page_from_page_settings( $ids, $post ) {
		if ( $post->ID === wc_get_page_id( 'shop' ) ) {
			$ids[ $post->ID ] = '<p><a href="' . esc_attr(
				add_query_arg(
					array(
						'autofocus[section]' => 'onestore_section_page_settings_product_archive',
						'url' => esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ),
					),
					admin_url( 'customize.php' )
				)
			) . '">' . esc_html__( 'Edit Page settings here', 'onestore' ) . '</a></p>';
		}

		return $ids;
	}

	/**
	 * Add "Product Layout" tab on Page Settings meta box.
	 *
	 * @param array $tabs
	 * @return array
	 */
	public function add_page_settings_tab__product( $tabs ) {
		if ( 'product' === get_current_screen()->post_type ) {
			$tabs['woocommerce-single'] = esc_html__( 'Product Layout', 'onestore' );
		}

		return $tabs;
	}

	/**
	 * Render "Product Layout" options on Page Settings meta box.
	 *
	 * @param WP_Post|WP_Term $obj
	 * @param string          $tab
	 */
	public function render_page_settings_fields__product( $obj, $tab ) {

	}

	/**
	 * Add fallback page settings value for "Product Layout" settings.
	 *
	 * @param array $settings
	 * @return array
	 */
	public function add_page_settings_fallback_values__product( $settings ) {
		$add = array(
			'woocommerce_single_breadcrumb' => onestore_get_theme_mod( 'woocommerce_single_breadcrumb' ),
			'woocommerce_single_gallery' => onestore_get_theme_mod( 'woocommerce_single_gallery' ),
			'woocommerce_single_gallery_layout' => onestore_get_theme_mod( 'woocommerce_single_gallery_layout' ),
			'woocommerce_single_tabs' => onestore_get_theme_mod( 'woocommerce_single_tabs' ),
			'woocommerce_single_up_sells' => onestore_get_theme_mod( 'woocommerce_single_up_sells' ),
			'woocommerce_single_related' => onestore_get_theme_mod( 'woocommerce_single_related' ),
		);

		return array_merge( $settings, $add );
	}

	/**
	 * ====================================================
	 * Global Hook functions
	 * ====================================================
	 */

	/**
	 * Add items count to Cart menu item.
	 *
	 * @param string  $title
	 * @param WP_Post $item
	 * @param array   $args
	 * @param integer $depth
	 * @return string
	 */
	public function add_count_to_cart_menu_item( $title, $item, $args, $depth ) {
		// Add items count to "Cart" menu.
		if ( 'page' == $item->object && $item->object_id == get_option( 'woocommerce_cart_page_id' ) ) {
			if ( strpos( $title, '{{count}}' ) ) {
				$cart = WC()->cart;
				if ( ! empty( $cart ) ) {
					$count = $cart->cart_contents_count;
				} else {
					$count = 0;
				}
				$title = str_replace( '{{count}}', '(<span class="shopping-cart-count" data-count="' . $count . '">' . $count . '</span>)', $title );
			}
		}

		return $title;
	}

	/**
	 * Improve products loop wrapper HTML markup.
	 *
	 * @param string $html
	 * @return string
	 */
	public function change_loop_start_markup( $html ) {
		$html = preg_replace( '/(class=".*?)"/', '$1 ' . implode( ' ', apply_filters( 'onestore/frontend/woocommerce/loop_classes', array() ) ) . '"', $html );

		return $html;
	}

	/**
	 * Mobile screen breakpoint.
	 *
	 * @param string $px
	 * @return string
	 */
	public function set_smallscreen_breakpoint( $px ) {
		return '767px';
	}

	/**
	 * AJAX update items count on header cart menu & icon.
	 */
	public function update_header_cart( $fragments ) {
		$count = WC()->cart->get_cart_contents_count();
		$fragments['.shopping-cart-count'] = '<span class="shopping-cart-count" data-count="' . $count . '">' . $count . '</span>';

		return $fragments;
	}



	/**
	 * Modify "added to cart" message.
	 *
	 * @param string  $message
	 * @param array   $products
	 * @param boolean $show_qty
	 * @return string
	 */
	public function change_add_to_cart_message_html( $message, $products, $show_qty ) {
		$message = preg_replace( '/(<a .*?>.*?<\/a>) (.*)/', '$2 $1', $message );

		return $message;
	}

	/**
	 * Modify flexslider settings on single product page.
	 *
	 * @param array $options
	 * @return array
	 */
	public function change_single_product_carousel_options( $options ) {
		$options['animation'] = 'fade';
		$options['animationSpeed'] = 250;
		return $options;
	}

	/**
	 * Add plus and minus buttons to the quantity input.
	 */
	public function add_quantity_plus_minus_buttons() {
		?>
		<span class="onestore-qty-increment onestore-qty-minus" role="button" tabindex="0">-</span>
		<span class="onestore-qty-increment onestore-qty-plus" role="button" tabindex="0">+</span>
		<?php
	}

	/**
	 * Add plus and minus buttons to the quantity input via JS.
	 */
	public function add_quantity_plus_minus_buttons_scripts() {
		// Add inline JS to initiate quantity plus minus UI.
		// This javascript uses jQuery to hook into WooCommerce event callback (WooCommerce uses jQuery).
		ob_start();
		?>
		(function() {
			'use strict';

			var handleWooCommerceQuantityIncrementButtons = function( e ) {
				// Only handle "onestore-qty-increment" button.
				if ( e.target.classList.contains( 'onestore-qty-increment' ) ) {
					// Prevent default handlers on click and touch event.
					if ( 'click' === e.type || 'touchend' === e.type ) {
						e.preventDefault();
					}

					// Abort if keydown is not enter or space key.
					else if ( 'keydown' === e.type && 13 !== e.which && 32 !== e.which ) {
						return;
					}

					var $button = e.target,
						$input = $button.parentElement.querySelector( '.qty' ),
						step = parseInt( $input.getAttribute( 'step' ) ),
						min = parseInt( $input.getAttribute( 'min' ) ),
						max = parseInt( $input.getAttribute( 'max' ) ),
						sign = $button.classList.contains( 'onestore-qty-minus' ) ? '-' : '+';

					// Adjust the input value according to the clicked button.
					if ( '-' === sign ) {
						var newValue = parseInt( $input.value ) - step;

						if ( min && min > newValue ) {
							$input.value = parseInt( min );
						} else {
							$input.value = parseInt( newValue );
						}
					} else {
						var newValue = parseInt( $input.value ) + step;

						if ( max && max < newValue ) {
							$input.value = parseInt( max );
						} else {
							$input.value = parseInt( newValue );
						}
					}

					// Trigger "change" event on the input field (use old fashioned way for IE compatibility).
					var event = document.createEvent( 'HTMLEvents' );
					event.initEvent( 'change', true, false);
					$input.dispatchEvent( event );
				}
			};

			document.body.addEventListener( 'click', handleWooCommerceQuantityIncrementButtons );
			document.body.addEventListener( 'touchend', handleWooCommerceQuantityIncrementButtons );
			document.body.addEventListener( 'keydown', handleWooCommerceQuantityIncrementButtons );
		})();
		<?php
		$js = ob_get_clean();

		// Add right after WooCommerce main js.
		wp_add_inline_script( 'woocommerce', $js );
	}

	/**
	 * ====================================================
	 * Shop Page Hook functions
	 * ====================================================
	 */



	/**
	 * Add opening product wrapper tag to products loop item.
	 */
	public function render_loop_item_wrapper() {
		?><div class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/woocommerce/loop_item_classes', array( 'onestore-product-wrapper' ) ) ) ); ?>"><?php
	}

	/**
	 * Add closing product wrapper tag to products loop item.
	 */
	public function render_loop_item_wrapper_end() {
		?></div><?php
	}

	/**
	 * Add opening product image wrapper tag.
	 */
	public function render_loop_product_thumbnail_wrapper() {
		?><div class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/woocommerce/loop_item_thumbnail_classes', array( 'onestore-product-thumbnail' ) ) ) ); ?>"><?php
	}

	/**
	 * Add closing product image wrapper tag.
	 */
	public function render_loop_product_thumbnail_wrapper_end() {
		?></div><?php
	}

	/**
	 * Set products loop posts per page.
	 *
	 * @param integer $posts_per_page
	 * @return integer
	 */
	public function set_loop_posts_per_page( $posts_per_page ) {
		return intval( onestore_get_theme_mod( 'woocommerce_index_posts_per_page' ) );
	}

	/**
	 * ====================================================
	 * Product Page Hook functions
	 * ====================================================
	 */

	/**
	 * Add some classes on single product wrapper on single product template.
	 *
	 * @param array   $classes
	 * @param array   $class
	 * @param integer $post_id
	 * @return array
	 */
	public function add_single_product_class() {
		add_filter( 'post_class', array( $this, 'add_single_product_class_filter' ), 10, 3 );
	}

	/**
	 * Add some classes on single product wrapper via filter.
	 *
	 * @param array   $classes
	 * @param array   $class
	 * @param integer $post_id
	 * @return array
	 */
	public function add_single_product_class_filter( $classes, $class, $post_id ) {
		$classes = apply_filters( 'onestore/frontend/woocommerce/single_product_classes', $classes );

		return $classes;
	}

	/**
	 * Add class on single product gallery whether it contains single image or multiple images.
	 *
	 * @param array $classes
	 * @return array
	 */
	public function add_single_product_gallery_class( $classes ) {
		global $product;

		$gallery_ids = $product->get_gallery_image_ids();

		if ( 0 < count( $gallery_ids ) ) {
			$classes['gallery_multiple_images'] = esc_attr( 'onestore-woocommerce-single-gallery-multiple-images' );
		}

		return $classes;
	}

	/**
	 * Set Product thumbnails columns in single product page.
	 *
	 * @param integer $columns
	 * @return integer
	 */
	public function set_product_thumbnails_columns( $columns ) {
		return 8;
	}

	/**
	 * Add opening add to cart form's wrapper tag.
	 */
	public function render_add_to_cart_form_wrapper() {
		?><div class="<?php echo esc_attr( implode( ' ', apply_filters( 'onestore/frontend/woocommerce/add_to_cart_form_classes', array( 'onestore-product-add-to-cart' ) ) ) ); ?>"><?php
	}

	/**
	 * Add closing add to cart form's wrapper tag.
	 */
	public function render_add_to_cart_form_wrapper_end() {
		?></div><?php
	}

	/**
	 * Set related products arguments.
	 *
	 * @param array $args Array of arguments
	 * @return array
	 */
	public function set_related_products_display_args( $args ) {
		$args['posts_per_page'] = intval( onestore_get_theme_mod( 'woocommerce_single_more_posts_per_page' ) );
		return $args;
	}


	/**
	 * Set up-sells products arguments.
	 *
	 * @param array $args Array of arguments
	 * @return array
	 */
	public function set_up_sells_display_args( $args ) {
		$args['posts_per_page'] = intval( onestore_get_theme_mod( 'woocommerce_single_more_posts_per_page' ) );

		return $args;
	}

	/**
	 * ====================================================
	 * Cart Page Hook functions
	 * ====================================================
	 */

	/**
	 * Add two columns layout class for cart page.
	 */
	public function add_cart_two_columns_class( $classes ) {
		$classes[] = 'onestore-woocommerce-cart-2-columns';

		return $classes;
	}

	/**
	 * Add opening 2 columns cart left columns wrapper tag.
	 */
	public function render_cart_2_columns_left_wrapper() {
		?><div class="onestore-woocommerce-cart-2-columns--left"><?php
	}

	/**
	 * Add closing 2 columns cart left columns wrapper tag.
	 */
	public function render_cart_2_columns_left_wrapper_end() {
		?></div><?php
	}

	/**
	 * Add opening 2 columns cart right columns wrapper tag.
	 */
	public function render_cart_2_columns_right_wrapper() {
		?><div class="onestore-woocommerce-cart-2-columns--right"><?php
	}

	/**
	 * Add opening 2 columns cart right columns wrapper tag.
	 */
	public function render_cart_2_columns_right_wrapper_end() {
		?></div><?php
	}

	/**
	 * Set cross-sells columns.
	 *
	 * @param integer $columns Number of columns
	 * @return integer
	 */
	public function set_cart_page_cross_sells_columns( $columns ) {
		return intval( onestore_get_theme_mod( 'woocommerce_cart_cross_sells_grid_columns' ) );
	}

	/**
	 * ====================================================
	 * Checkout Page Hook functions
	 * ====================================================
	 */

	/**
	 * Add two columns layout class for checkout page.
	 */
	public function add_checkout_two_columns_class( $classes ) {
		$classes[] = 'onestore-woocommerce-checkout-2-columns';

		return $classes;
	}

	/**
	 * Add opening 2 columns checkout left columns wrapper tag.
	 */
	public function render_checkout_2_columns_left_wrapper() {
		?><div class="onestore-woocommerce-checkout-2-columns--left"><?php
	}

	/**
	 * Add closing 2 columns checkout left columns wrapper tag.
	 */
	public function render_checkout_2_columns_left_wrapper_end() {
		?></div><?php
	}

	/**
	 * Add opening 2 columns checkout right columns wrapper tag.
	 */
	public function render_checkout_2_columns_right_wrapper() {
		?><div class="onestore-woocommerce-checkout-2-columns--right"><?php
	}

	/**
	 * Add opening 2 columns checkout right columns wrapper tag.
	 */
	public function render_checkout_2_columns_right_wrapper_end() {
		?></div><?php
	}

	/**
	 * ====================================================
	 * My Account Page Hook functions
	 * ====================================================
	 */

	/**
	 * Add opening wrapper tag to wrap account sidebar.
	 */
	public function render_account_sidebar_wrapper() {
		$user = wp_get_current_user();
		?>
		<div class="onestore-woocommerce-MyAccount-sidebar">
			<div class="onestore-woocommerce-MyAccount-user">
				<?php echo get_avatar( $user->user_ID, 60 ); ?>
				<strong class="name"><?php echo esc_html( $user->display_name ); ?></strong>
			</div>
		<?php
	}

	/**
	 * Add closing wrapper tag to wrap account sidebar.
	 */
	public function render_account_sidebar_wrapper_end() {
		?>
		</div>
		<?php
	}
}

OneStore_Compatibility_WooCommerce::instance();
