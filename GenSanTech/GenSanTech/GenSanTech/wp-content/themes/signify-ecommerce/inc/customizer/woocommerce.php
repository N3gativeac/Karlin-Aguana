<?php
/**
 * Adding support for WooCommerce Plugin
 */

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'signify_is_woocommerce_activated' ) ) {
    function signify_is_woocommerce_activated() {
        return class_exists( 'WooCommerce' ) ? true : false;
    }
}

if ( ! class_exists( 'WooCommerce' ) ) {
    // Bail if WooCommerce is not installed
    return;
}

/**
 * Add WooCommerce Options to customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_woocommerce_options( $wp_customize ) {
    signify_register_option( $wp_customize, array(
            'name'              => 'signify_woocommerce_layout',
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'signify_sanitize_select',
            'description'       => esc_html__( 'Layout for WooCommerce Pages', 'signify-ecommerce' ),
            'label'             => esc_html__( 'WooCommerce Layout', 'signify-ecommerce' ),
            'section'           => 'signify_layout_options',
            'type'              => 'radio',
            'choices'           => array(
                'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'signify-ecommerce' ),
                'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'signify-ecommerce' ),
            ),
        )
    );
}
add_action( 'customize_register', 'signify_woocommerce_options', 50 );

if ( ! function_exists( 'signify_woocommerce_setup' ) ) :
    /**
     * Sets up support for various WooCommerce features.
     */
    function signify_woocommerce_setup() {
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width'         => 660,
            'single_image_width'            => 580,
            'gallery_thumbnail_image_width' => 150,
        ) );

        add_theme_support('wc-ecommerceduct-gallery-zoom');

        add_theme_support('wc-ecommerceduct-gallery-lightbox');

        add_theme_support('wc-ecommerceduct-gallery-slider');
    }
endif; //signify_woocommerce_setup
add_action( 'after_setup_theme', 'signify_woocommerce_setup' );

/**
 * uses remove_action to remove the WooCommerce Wrapper and add_action to add Main Wrapper
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'signify_woocommerce_start' ) ) :
    function signify_woocommerce_start() {
    	echo '<div id="primary" class="content-area"><main role="main" class="site-main woocommerce" id="main"><div class="woocommerce-posts-wrapper">';
    }
endif; //signify_woocommerce_start
add_action( 'woocommerce_before_main_content', 'signify_woocommerce_start', 15 );

if ( ! function_exists( 'signify_woocommerce_end' ) ) :
    function signify_woocommerce_end() {
    	echo '</div><!-- .woocommerce-posts-wrapper --></main><!-- #main --></div><!-- #primary -->';
    }
endif; //signify_woocommerce_end
add_action( 'woocommerce_after_main_content', 'signify_woocommerce_end', 15 );

function signify_woocommerce_shorting_start() {
	echo '<div class="woocommerce-shorting-wrapper">';
}
add_action( 'woocommerce_before_shop_loop', 'signify_woocommerce_shorting_start', 10 );

function signify_woocommerce_shorting_end() {
	echo '</div><!-- .woocommerce-shorting-wrapper -->';
}
add_action( 'woocommerce_before_shop_loop', 'signify_woocommerce_shorting_end', 40 );

function signify_woocommerce_product_container_start() {
	echo '<div class="product-container">';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'signify_woocommerce_product_container_start', 20 );

function signify_woocommerce_product_container_end() {
	echo '</div><!-- .product-container -->';
}
add_action( 'woocommerce_after_shop_loop_item', 'signify_woocommerce_product_container_end', 20 );

if ( ! function_exists( 'signify_header_cart' ) ) {
    /**
     * Display Header Cart
     *
     * @since  1.0.0
     * @uses  signify_is_woocommerce_activated() check if WooCommerce is activated
     * @return void
     */
    function signify_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <div id="site-header-cart-wrapper" class="menu-wrapper">
            <ul id="site-header-cart" class="site-header-cart menu">
                <li class="<?php echo esc_attr( $class ); ?>">
                    <?php signify_cart_link(); ?>
                </li>
                <li>
                    <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                </li>
            </ul>
        </div>
        <?php
    }
}

if ( ! function_exists( 'signify_cart_link' ) ) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     *
     * @return void
     * @since  1.0.0
     */
    function signify_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'signify-ecommerce' ); ?>"><?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?><span class="count"><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></span></a>
        <?php
    }
}

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function signify_woocommerce_active_body_class( $classes ) {
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter( 'body_class', 'signify_woocommerce_active_body_class' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function signify_woocommerce_scripts() {
    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
            font-family: "star";
            src: url("' . $font_path . 'star.eot");
            src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
                url("' . $font_path . 'star.woff") format("woff"),
                url("' . $font_path . 'star.ttf") format("truetype"),
                url("' . $font_path . 'star.svg#star") format("svg");
            font-weight: normal;
            font-style: normal;
        }';

    wp_add_inline_style( 'signify-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'signify_woocommerce_scripts' );

if ( ! function_exists( 'signify_woocommerce_product_columns_wrapper' ) ) {
    /**
     * Product columns wrapper.
     *
     * @return  void
     */
    function signify_woocommerce_product_columns_wrapper() {
        // Get option from Customizer=> WooCommerce=> Product Catlog=> Products per row.
        echo '<div class="wocommerce-section-content-wrapper columns-' . absint( get_option( 'woocommerce_catalog_columns', 4 ) ) . '">';
    }
}
add_action( 'woocommerce_before_shop_loop', 'signify_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'signify_woocommerce_product_columns_wrapper_close' ) ) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function signify_woocommerce_product_columns_wrapper_close() {
        echo '</div>';
    }
}
add_action( 'woocommerce_after_shop_loop', 'signify_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Make Shop Page Title dynamic
 */
function signify_woocommerce_shop_subtitle( $args ) {
    if ( is_shop() ) {
        return wp_kses_post( get_theme_mod( 'signify_shop_subtitle', esc_html__( 'This is where you can add new products to your store.', 'signify-ecommerce' ) ) );
    }

    return $args;
}
add_filter( 'get_the_archive_description', 'signify_woocommerce_shop_subtitle', 20 );

/**
* woo_hide_page_title
*
* Removes the "shop" title on the main shop page
*
* @access      public
* @since       1.0
* @return      void
*/

function signify_woocommerce_hide_page_title() {
    if ( is_shop() && signify_has_header_media_text() ) {
        return false;
    }

    return true;
}
add_filter( 'woocommerce_show_page_title', 'signify_woocommerce_hide_page_title' );

/**
 * Include Woo Products Showcase
 */
require get_theme_file_path( 'inc/customizer/woo-products-showcase.php' );
