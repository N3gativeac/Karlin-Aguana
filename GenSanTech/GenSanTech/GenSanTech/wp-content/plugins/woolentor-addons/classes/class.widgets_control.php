<?php

namespace WooLentor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Widgets Control
*/
class Widgets_Control{
    
    private static $instance = null;
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function __construct(){
        $this->init();
    }

    public function init() {

        // Register custom category
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

        // Init Widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

    }

    // Add custom category.
    public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'woolentor-addons',
            [
               'title'  => __( 'Woolentor Addons','woolentor'),
                'icon' => 'font',
            ]
        );
    }

    // Widgets Register
    public function init_widgets(){

        $wl_element_manager = array(
            'product_tabs',
            'add_banner',
            'special_day_offer',
            'wb_image_marker',
            'wl_store_features',
            'wl_faq',
            'wl_category_grid',
            'wl_onepage_slider',
        );

        if( is_plugin_active('wishsuite/wishsuite.php') ){
            $wl_element_manager[] = 'wb_wishsuite_table';
        }

        if( is_plugin_active('ever-compare/ever-compare.php') ){
            $wl_element_manager[] = 'wb_ever_compare_table';
        }

        if( is_plugin_active('just-tables/just-tables.php') || is_plugin_active('just-tables-pro/just-tables-pro.php') ){
            $wl_element_manager[] = 'wb_just_table';
        }

        if( is_plugin_active('whols/whols.php') || is_plugin_active('whols-pro/whols-pro.php') ){
            $wl_element_manager[] = 'wb_whols';
        }

        if( is_plugin_active('wc-multi-currency/wcmilticurrency.php') || is_plugin_active('multicurrencypro/multicurrencypro.php') ){
            $wl_element_manager[] = 'wb_wc_multicurrency';
        }

        if( !is_plugin_active('woolentor-addons-pro/woolentor_addons_pro.php') ){
            $wl_element_manager[] = 'universal_product';
            $wl_element_manager[] = 'wl_category';
            $wl_element_manager[] = 'wl_brand';
            $wl_element_manager[] = 'wb_customer_review';
            $wl_element_manager[] = 'wl_testimonial';
        }

        // WooCommerce Builder
        if( woolentor_get_option( 'enablecustomlayout', 'woolentor_woo_template_tabs', 'on' ) == 'on' ){
            $wlb_element  = array(
                'wb_archive_product',
                'wl_product_filter',
                'wl_product_horizontal_filter',
                'wb_product_title',
                'wb_product_related',
                'wb_product_add_to_cart',
                'wb_product_additional_information',
                'wb_product_data_tab',
                'wb_product_description',
                'wb_product_short_description',
                'wb_product_price',
                'wb_product_rating',
                'wb_product_reviews',
                'wb_product_image',
                'wl_product_video_gallery',
                'wb_product_upsell',
                'wb_product_stock',
                'wb_product_meta',
                'wb_product_call_for_price',
                'wb_product_suggest_price',
                'wb_product_qr_code',
                'product_curvy',
                'product_image_accordion',
                'product_accordion',
            );
        }else{ $wlb_element  = array(); }
        $wl_element_manager = array_merge( $wl_element_manager, $wlb_element );

        foreach ( $wl_element_manager as $element ){
            if (  ( woolentor_get_option( $element, 'woolentor_elements_tabs', 'on' ) === 'on' ) && file_exists( WOOLENTOR_ADDONS_PL_PATH.'includes/addons/'.$element.'.php' ) ){
                require( WOOLENTOR_ADDONS_PL_PATH.'includes/addons/'.$element.'.php' );
            }
        }
        
    }


}

Widgets_Control::instance();