<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Woolentor_Admin_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new Woolentor_Settings_API();

        add_action( 'admin_init', [ $this, 'admin_init' ] );
        add_action( 'admin_menu', [ $this, 'admin_menu' ], 220 );
        
        add_action( 'wsa_form_bottom_woolentor_general_tabs', [ $this, 'woolentor_html_general_tabs' ] );
        add_action( 'wsa_form_top_woolentor_elements_tabs', [ $this, 'woolentor_html_popup_box' ] );
        add_action( 'wsa_form_bottom_woolentor_themes_library_tabs', [ $this, 'woolentor_html_themes_library_tabs' ] );

        add_action( 'wsa_form_top_woolentor_style_tabs', [ $this, 'style_tab_html' ] );
        add_action( 'wsa_form_bottom_woolentor_style_tabs', [ $this, 'style_tab_bottom_html' ] );
        
        add_action( 'wsa_form_bottom_woolentor_buy_pro_tabs', [ $this, 'woolentor_html_buy_pro_tabs' ] );

    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->woolentor_admin_get_settings_sections() );
        $this->settings_api->set_fields( $this->woolentor_admin_fields_settings() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    // Plugins menu Register
    function admin_menu() {

        $menu = 'add_menu_' . 'page';
        $menu(
            'woolentor_panel',
            esc_html__( 'WooLentor', 'woolentor' ),
            esc_html__( 'WooLentor', 'woolentor' ),
            'woolentor_page',
            NULL,
            WOOLENTOR_ADDONS_PL_URL.'includes/admin/assets/images/menu-icon.png',
            100
        );
        
        add_submenu_page(
            'woolentor_page', 
            esc_html__( 'Settings', 'woolentor' ),
            esc_html__( 'Settings', 'woolentor' ), 
            'manage_options', 
            'woolentor', 
            array ( $this, 'plugin_page' ) 
        );

    }

    // Options page Section register
    function woolentor_admin_get_settings_sections() {
        $sections = array(
            
            array(
                'id'    => 'woolentor_general_tabs',
                'title' => esc_html__( 'General', 'woolentor' )
            ),

            array(
                'id'    => 'woolentor_woo_template_tabs',
                'title' => esc_html__( 'WooCommerce Template', 'woolentor' )
            ),

            array(
                'id'    => 'woolentor_elements_tabs',
                'title' => esc_html__( 'Elements', 'woolentor' )
            ),

            array(
                'id'    => 'woolentor_themes_library_tabs',
                'title' => esc_html__( 'Theme Library', 'woolentor' )
            ),

            array(
                'id'    => 'woolentor_rename_label_tabs',
                'title' => esc_html__( 'Rename Label', 'woolentor' )
            ),

            array(
                'id'    => 'woolentor_sales_notification_tabs',
                'title' => esc_html__( 'Sales Notification', 'woolentor' )
            ),

            array(
                'id'    => 'woolentor_others_tabs',
                'title' => esc_html__( 'Other', 'woolentor' )
            ),

            array(
                'id'    => 'woolentor_style_tabs',
                'title' => esc_html__( 'Style', 'woolentor' )
            ),

            array(
                'id'    => 'woolentor_buy_pro_tabs',
                'title' => esc_html__( 'Buy Pro', 'woolentor' )
            ),

        );
        return $sections;
    }

    // Options page field register
    protected function woolentor_admin_fields_settings() {

        $settings_fields = array(

            'woolentor_general_tabs' => array(),

            'woolentor_woo_template_tabs' => array(

                array(
                    'name'  => 'enablecustomlayout',
                    'label'  => __( 'Enable / Disable Template Builder', 'woolentor' ),
                    'desc'  => __( 'Enable', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                ),

                array(
                    'name'  => 'shoppageproductlimit',
                    'label' => __( 'Product Limit', 'woolentor' ),
                    'desc' => wp_kses_post( 'You can handle the product limit for the Shop page', 'woolentor' ),
                    'min'               => 1,
                    'max'               => 100,
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '2',
                    'sanitize_callback' => 'floatval',
                    'class' => 'depend_enable_custom_layout',
                ),

                array(
                    'name'    => 'singleproductpage',
                    'label'   => __( 'Single Product Template', 'woolentor' ),
                    'desc'    => __( 'You can select a custom template for the product details page layout', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woolentor_elementor_template(),
                    'class' => 'depend_enable_custom_layout',
                ),

                array(
                    'name'    => 'productarchivepage',
                    'label'   => __( 'Product Archive Page Template', 'woolentor' ),
                    'desc'    => __( 'You can select a custom template for the Shop page layout', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => woolentor_elementor_template(),
                    'class' => 'depend_enable_custom_layout',
                ),

                array(
                    'name'    => 'productcartpagep',
                    'label'   => __( 'Cart Page Template', 'woolentor' ),
                    'desc'    => __( 'You can select a template for the Cart page layout <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select a template for the cart page layout',
                    ),
                    'class'=>'proelement depend_enable_custom_layout',
                ),

                array(
                    'name'    => 'productcheckoutpagep',
                    'label'   => __( 'Checkout Page Template', 'woolentor' ),
                    'desc'    => __( 'You can select a template for the Checkout page layout <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select a template for the Checkout page layout',
                    ),
                    'class'=>'proelement depend_enable_custom_layout',
                ),

                array(
                    'name'    => 'productthankyoupagep',
                    'label'   => __( 'Thank You Page Template', 'woolentor' ),
                    'desc'    => __( 'Select a template for the Thank you page layout <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select a template for the Thank you page layout',
                    ),
                    'class'=>'proelement depend_enable_custom_layout',
                ),

                array(
                    'name'    => 'productmyaccountpagep',
                    'label'   => __( 'My Account Page Template', 'woolentor' ),
                    'desc'    => __( 'Select a template for the My Account page layout <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select Template',
                    ),
                    'class'=>'proelement depend_enable_custom_layout',
                ),

                array(
                    'name'    => 'productmyaccountloginpagep',
                    'label'   => __( 'My Account Login page Template', 'woolentor' ),
                    'desc'    => __( 'Select a template for the Login page layout <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select Template',
                    ),
                    'class'=>'proelement depend_enable_custom_layout',
                ),

                array(
                    'name'    => 'productquickviewp',
                    'label'   => esc_html__( 'Quick View Template', 'woolentor' ),
                    'desc'    => __( 'Select a template for the product\'s quick view layout <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => array(
                        'select'=>'Select Template',
                    ),
                    'class'=>'proelement depend_enable_custom_layout',
                ),

            ),

            'woolentor_elements_tabs' => array(

                array(
                    'name'  => 'product_tabs',
                    'label'  => __( 'Product Tab', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'universal_product',
                    'label'  => __( 'Universal Product', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'product_curvy',
                    'label'  => __( 'WL: Product Curvy', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'product_image_accordion',
                    'label'  => __( 'WL: Product Image Accordion', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'product_accordion',
                    'label'  => __( 'WL: Product Accordion', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'add_banner',
                    'label'  => __( 'Ads Banner', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'special_day_offer',
                    'label'  => __( 'Special Day Offer', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_customer_review',
                    'label'  => __( 'Customer Review', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_image_marker',
                    'label'  => __( 'Image Marker', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_category',
                    'label'  => __( 'Category List', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_category_grid',
                    'label'  => __( 'Category Grid', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_onepage_slider',
                    'label'  => __( 'One page slider', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_testimonial',
                    'label'  => __( 'Testimonial', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_store_features',
                    'label'  => __( 'Store Features', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_faq',
                    'label'  => __( 'Faq', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_brand',
                    'label'  => __( 'Brand Logo', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_archive_product',
                    'label'  => __( 'Product Archive', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_product_filter',
                    'label'  => __( 'Product Filter', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_product_horizontal_filter',
                    'label'  => __( 'Product Horizontal Filter', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_title',
                    'label'  => __( 'Product Title', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_related',
                    'label'  => __( 'Related Product', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_add_to_cart',
                    'label'  => __( 'Add to Cart Button', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_additional_information',
                    'label'  => __( 'Additional Information', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_data_tab',
                    'label'  => __( 'Product Data Tab', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_description',
                    'label'  => __( 'Product Description', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_short_description',
                    'label'  => __( 'Product Short Description', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_price',
                    'label'  => __( 'Product Price', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_rating',
                    'label'  => __( 'Product Rating', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_reviews',
                    'label'  => __( 'Product Reviews', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_image',
                    'label'  => __( 'Product Image', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_product_video_gallery',
                    'label'  => __( 'Product Video Gallery', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_upsell',
                    'label'  => __( 'Product Upsell', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_stock',
                    'label'  => __( 'Product Stock Status', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_meta',
                    'label'  => __( 'Product Meta Info', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_call_for_price',
                    'label'  => __( 'Call for Price', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_suggest_price',
                    'label'  => __( 'Suggest Price', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wb_product_qr_code',
                    'label'  => __( 'QR Code', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'wl_product_expanding_gridp',
                    'label'  => __( 'Product Expanding Grid <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_product_filterable_gridp',
                    'label'  => __( 'Product Filterable Grid <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_custom_archive_layoutp',
                    'label'  => __( 'Product Archive Layout <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_product_pgridp',
                    'label'  => __( 'Product Grid <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_cart_tablep',
                    'label'  => __( 'Product Cart Table <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_cart_totalp',
                    'label'  => __( 'Product Cart Total <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_cartempty_messagep',
                    'label'  => __( 'Empty Cart Mes..<span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_cartempty_shopredirectp',
                    'label'  => __( 'Empty Cart Re.. Button <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_cross_sellp',
                    'label'  => __( 'Product Cross Sell <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_cross_sell_customp',
                    'label'  => __( 'Cross Sell ..( Custom ) <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_checkout_additional_formp',
                    'label'  => __( 'Checkout Additional.. <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_checkout_billingp',
                    'label'  => __( 'Checkout Billing Form <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_checkout_shipping_formp',
                    'label'  => __( 'Checkout Shipping Form <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_checkout_paymentp',
                    'label'  => __( 'Checkout Payment <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_checkout_coupon_formp',
                    'label'  => __( 'Checkout Co.. Form <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_checkout_login_formp',
                    'label'  => __( 'Checkout lo.. Form <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_order_reviewp',
                    'label'  => __( 'Checkout Order Review <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_myaccount_accountp',
                    'label'  => __( 'My Account <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_myaccount_dashboardp',
                    'label'  => __( 'My Account Dashboard <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_myaccount_downloadp',
                    'label'  => __( 'My Account Download <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_myaccount_edit_accountp',
                    'label'  => __( 'My Account Edit<span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_myaccount_addressp',
                    'label'  => __( 'My Account Address <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_myaccount_login_formp',
                    'label'  => __( 'Login Form <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_myaccount_register_formp',
                    'label'  => __( 'Registration Form <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_myaccount_logoutp',
                    'label'  => __( 'My Account Logout <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_myaccount_orderp',
                    'label'  => __( 'My Account Order <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_thankyou_orderp',
                    'label'  => __( 'Thank You Order <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_thankyou_customer_address_detailsp',
                    'label'  => __( 'Thank You Cus.. Address <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_thankyou_order_detailsp',
                    'label'  => __( 'Thank You Order Details <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_product_advance_thumbnailsp',
                    'label'  => __( 'Advance Product Image <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_product_advance_thumbnails_zoom_p',
                    'label'  => __( 'Product Zoom<span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_social_sherep',
                    'label'  => __( 'Product Social Share <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_stock_progress_barp',
                    'label'  => __( 'Stock Progressbar <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),
                array(
                    'name'  => 'wl_single_product_sale_schedulep',
                    'label'  => __( 'Product Sale Schedule <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_related_productp',
                    'label'  => __( 'Related Pro..( Custom ) <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_product_upsell_customp',
                    'label'  => __( 'Upsell Pro..( Custom ) <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

                array(
                    'name'  => 'wl_mini_cartp',
                    'label'  => __( 'Mini Cart <span>( Pro )</span>', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row pro',
                ),

            ),

            'woolentor_themes_library_tabs' => array(),
            'woolentor_rename_label_tabs' => array(
                
                array(
                    'name'  => 'enablerenamelabel',
                    'label'  => __( 'Enable / Disable Rename Label', 'woolentor' ),
                    'desc'  => __( 'Enable', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'   =>'woolentor_table_row enablerenamelabel',
                ),

                array(
                    'name'      => 'shop_page_heading',
                    'headding'  => __( 'Shop Page', 'woolentor' ),
                    'type'      => 'title',
                    'class'     => 'depend_enable_rename_label',
                ),
                
                array(
                    'name'        => 'wl_shop_add_to_cart_txt',
                    'label'       => __( 'Add to Cart Button Text', 'woolentor' ),
                    'desc'        => __( 'Change the Add to Cart button text for the Shop page.', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Add to Cart', 'woolentor' ),
                    'class'       => 'depend_enable_rename_label',
                ),

                array(
                    'name'      => 'product_details_page_heading',
                    'headding'  => __( 'Product Details Page', 'woolentor' ),
                    'type'      => 'title',
                    'class'     => 'depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_add_to_cart_txt',
                    'label'       => __( 'Add to Cart Button Text', 'woolentor' ),
                    'desc'        => __( 'Change the Add to Cart button text for the Product details page.', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Add to Cart', 'woolentor' ),
                    'class'       => 'depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_description_tab_menu_titlep',
                    'label'       => __( 'Description', 'woolentor' ),
                    'desc'        => __( 'Change the tab title for the product description. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Description', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),
                
                array(
                    'name'        => 'wl_additional_information_tab_menu_titlep',
                    'label'       => __( 'Additional Information', 'woolentor' ),
                    'desc'        => __( 'Change the tab title for the product additional information <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Additiona information', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),
                
                array(
                    'name'        => 'wl_reviews_tab_menu_titlep',
                    'label'       => __( 'Reviews', 'woolentor' ),
                    'desc'        => __( 'Change the tab title for the product review <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Reviews', 'woolentor' ),
                    'class'       =>'proelement depend_enable_rename_label',
                ),

                array(
                    'name'      => 'checkout_page_headingp',
                    'headding'  => __( 'Checkout Page', 'woolentor' ),
                    'type'      => 'title',
                    'class'     => 'depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_firstname_labelp',
                    'label'       => __( 'First name', 'woolentor' ),
                    'desc'        => __( 'Change the label for the First name field <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'First name', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_lastname_labelp',
                    'label'       => __( 'Last name', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Last name field <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Last name', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_company_labelp',
                    'label'       => __( 'Company name', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Company field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Company name', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_address_1_labelp',
                    'label'       => __( 'Street address', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Street address field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Street address', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_address_2_labelp',
                    'label'       => __( 'Address Optional', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Optional address field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Address Optional', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_city_labelp',
                    'label'       => __( 'Town / City', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Town/City field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Town / City', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_postcode_labelp',
                    'label'       => __( 'Postcode / ZIP', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Postcode / ZIP field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Postcode / ZIP', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_state_labelp',
                    'label'       => __( 'State', 'woolentor' ),
                    'desc'        => __( 'Change the label for the State field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'State', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_phone_labelp',
                    'label'       => __( 'Phone', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Phone field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Phone', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_email_labelp',
                    'label'       => __( 'Email address', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Email address field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Email address', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_country_labelp',
                    'label'       => __( 'Country', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Country field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Country', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_ordernote_labelp',
                    'label'       => __( 'Order Note', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Order notes field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Order notes', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

                array(
                    'name'        => 'wl_checkout_placeorder_btn_txtp',
                    'label'       => __( 'Place order', 'woolentor' ),
                    'desc'        => __( 'Change the label for the Place order field. <span>( Pro )</span>', 'woolentor' ),
                    'type'        => 'text',
                    'placeholder' => __( 'Place order', 'woolentor' ),
                    'class'       => 'proelement depend_enable_rename_label',
                ),

            ),
            
            'woolentor_sales_notification_tabs'=>array(

                array(
                    'name'  => 'enableresalenotification',
                    'label'  => __( 'Enable / Disable Sales Notification', 'woolentor' ),
                    'desc'  => __( 'Enable', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row enableresalenotification',
                ),

                array(
                    'name'    => 'notification_content_typep',
                    'label'   => __( 'Notification Content Type', 'woolentor' ),
                    'desc'    => __( 'Select Content Type <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'radio',
                    'default' => 'actual',
                    'options' => array(
                        'actual' => __('Real','woolentor'),
                        'fakes'  => __('Manual','woolentor'),
                    ),
                    'class'=>'proelement',
                ),

                array(
                    'name'    => 'notification_posp',
                    'label'   => __( 'Position', 'woolentor' ),
                    'desc'    => __( 'Set the position of the Sales Notification.( Top Left, Top Right, Bottom Right option are pro features ) <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => 'bottomleft',
                    'options' => array(
                        'bottomleft'    =>__( 'Bottom Left','woolentor' ),
                    ),
                    'class'=>'proelement',
                ),

                array(
                    'name'    => 'notification_layoutp',
                    'label'   => __( 'Image Position', 'woolentor' ),
                    'desc'    => __( 'Set the image position of the notification. <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => 'imageleft',
                    'options' => array(
                        'imageleft'       =>__( 'Image Left','woolentor' ),
                    ),
                    'class'       => 'notification_real proelement'
                ),

                array(
                    'name'    => 'notification_loadduration',
                    'label'   => __( 'First loading time', 'woolentor' ),
                    'desc'    => __( 'When to start notification load duration.', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '3',
                    'options' => array(
                        '2'       =>__( '2 seconds','woolentor' ),
                        '3'       =>__( '3 seconds','woolentor' ),
                        '4'       =>__( '4 seconds','woolentor' ),
                        '5'       =>__( '5 seconds','woolentor' ),
                        '6'       =>__( '6 seconds','woolentor' ),
                        '7'       =>__( '7 seconds','woolentor' ),
                        '8'       =>__( '8 seconds','woolentor' ),
                        '9'       =>__( '9 seconds','woolentor' ),
                        '10'       =>__( '10 seconds','woolentor' ),
                        '20'       =>__( '20 seconds','woolentor' ),
                        '30'       =>__( '30 seconds','woolentor' ),
                        '40'       =>__( '40 seconds','woolentor' ),
                        '50'       =>__( '50 seconds','woolentor' ),
                        '60'       =>__( '1 minute','woolentor' ),
                        '90'       =>__( '1.5 minutes','woolentor' ),
                        '120'       =>__( '2 minutes','woolentor' ),
                    ),
                ),

                array(
                    'name'    => 'notification_time_showingp',
                    'label'   => esc_html__( 'Notification showing time', 'woolentor' ),
                    'desc'    => __( 'How long to keep the notification. <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '5',
                    'options' => array(
                        '5'       =>esc_html__( '5 seconds','woolentor' ),
                    ),
                    'class' => 'proelement',
                ),

                array(
                    'name'    => 'notification_time_intp',
                    'label'   => __( 'Time Interval', 'woolentor' ),
                    'desc'    => __( 'Set the interval time between notifications. <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '4',
                    'options' => array(
                        '2'       =>__( '2 seconds','woolentor' ),
                        '4'       =>__( '4 seconds','woolentor' ),
                        '5'       =>__( '5 seconds','woolentor' ),
                        '6'       =>__( '6 seconds','woolentor' ),
                        '7'       =>__( '7 seconds','woolentor' ),
                        '8'       =>__( '8 seconds','woolentor' ),
                        '9'       =>__( '9 seconds','woolentor' ),
                        '10'       =>__( '10 seconds','woolentor' ),
                        '20'       =>__( '20 seconds','woolentor' ),
                        '30'       =>__( '30 seconds','woolentor' ),
                        '40'       =>__( '40 seconds','woolentor' ),
                        '50'       =>__( '50 seconds','woolentor' ),
                        '60'       =>__( '1 minute','woolentor' ),
                        '90'       =>__( '1.5 minutes','woolentor' ),
                        '120'       =>__( '2 minutes','woolentor' ),
                    ),
                    'class' => 'proelement',
                ),

                array(
                    'name'              => 'notification_limit',
                    'label'             => __( 'Limit', 'woolentor' ),
                    'desc'              => __( 'Set the number of notifications to display.', 'woolentor' ),
                    'min'               => 1,
                    'max'               => 100,
                    'default'           => '5',
                    'step'              => '1',
                    'type'              => 'number',
                    'sanitize_callback' => 'number',
                    'class'       => 'notification_real',
                ),

                array(
                    'name'    => 'notification_uptodatep',
                    'label'   => __( 'Order Upto', 'woolentor' ),
                    'desc'    => __( 'Do not show purchases older than.( More Options are available in the Pro version ) <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => '7',
                    'options' => array(
                        '7'   =>__( '1 week','woolentor' ),
                    ),
                    'class'       => 'notification_real',
                ),

                array(
                    'name'    => 'notification_inanimationp',
                    'label'   => __( 'Animation In', 'woolentor' ),
                    'desc'    => __( 'Choose entrance animation. <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => 'fadeInLeft',
                    'options' => array(
                        'fadeInLeft'  =>__( 'fadeInLeft','woolentor' ),
                    ),
                    'class' => 'proelement',
                ),

                array(
                    'name'    => 'notification_outanimationp',
                    'label'   => __( 'Animation Out', 'woolentor' ),
                    'desc'    => __( 'Choose exit animation. <span>( Pro )</span>', 'woolentor' ),
                    'type'    => 'select',
                    'default' => 'fadeOutRight',
                    'options' => array(
                        'fadeOutRight'  =>__( 'fadeOutRight','woolentor' ),
                    ),
                    'class' => 'proelement',
                ),
                
                array(
                    'name'  => 'background_colorp',
                    'label' => __( 'Background Color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Set the background color of the notification. <span>( Pro )</span>', 'woolentor' ),
                    'type' => 'color',
                    'class'       => 'notification_real proelement',
                ),

                array(
                    'name'  => 'heading_colorp',
                    'label' => __( 'Heading Color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Set the heading color of the notification. <span>( Pro )</span>', 'woolentor' ),
                    'type' => 'color',
                    'class'       => 'notification_real proelement',
                ),

                array(
                    'name'  => 'content_colorp',
                    'label' => __( 'Content Color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Set the content color of the notification. <span>( Pro )</span>', 'woolentor' ),
                    'type' => 'color',
                    'class'       => 'notification_real proelement',
                ),

                array(
                    'name'  => 'cross_colorp',
                    'label' => __( 'Cross Icon Color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Set the cross icon color of the notification. <span>( Pro )</span>', 'woolentor' ),
                    'type' => 'color',
                    'class'       => 'proelement',
                ),

            ),

            'woolentor_others_tabs'=>array(

                array(
                    'name'  => 'loadproductlimit',
                    'label' => __( 'Load Products in Elementor Addons', 'woolentor' ),
                    'desc' => wp_kses_post( 'Set the number of products to load in Elementor Addons', 'woolentor' ),
                    'min'               => 1,
                    'max'               => 100,
                    'step'              => '1',
                    'type'              => 'number',
                    'default'           => '20',
                    'sanitize_callback' => 'floatval',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'ajaxsearch',
                    'label'  => __( 'Ajax Search Widget', 'woolentor' ),
                    'desc' => wp_kses_post( 'AJAX Search Widget', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row',
                ),

                array(
                    'name'  => 'ajaxcart_singleproduct',
                    'label'  => __( 'Single Product Ajax Add To Cart', 'woolentor' ),
                    'desc' => wp_kses_post( 'AJAX Add to Cart on Single Product page', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'woolentor_table_row',
                ),
                
                array(
                    'name'  => 'single_product_sticky_add_to_cartp',
                    'label'  => __( 'Single Product Sticky Add To Cart <span>( Pro )</span>', 'woolentor' ),
                    'desc' => wp_kses_post( 'Sticky Add to Cart on Single Product page', 'woolentor' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'   => 'woolentor_table_row pro',
                ),

                array(
                    'name'   => 'mini_side_cartp',
                    'label'  => __( 'Side Mini Cart <span>( Pro )</span>', 'woolentor' ),
                    'type'   => 'checkbox',
                    'default'=> 'off',
                    'class'  =>'woolentor_table_row pro',
                ),

                array(
                    'name'    => 'mini_cart_positionp',
                    'label'   => __( 'Mini Cart Position <span>( Pro )</span>', 'woolentor' ),
                    'desc'    => esc_html__( 'Set the position of the Mini Cart.', 'woolentor' ),
                    'type'    => 'select',
                    'default' => 'left',
                    'options' => array(
                        'left'   => esc_html__( 'Left','woolentor' ),
                    ),
                    'class'  =>'woolentor_table_row proelement',
                ),

                array(
                    'name'   => 'multi_step_checkoutp',
                    'label'  => __( 'Multi Step Checkout <span>( Pro )</span>', 'woolentor' ),
                    'type'   => 'checkbox',
                    'default'=> 'off',
                    'class'  =>'woolentor_table_row pro',
                ),

            ),

            'woolentor_style_tabs' => array(

                array(
                    'name'  => 'content_area_bg',
                    'label' => __( 'Content area background', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#ffffff',
                ),

                array(
                    'name'      => 'section_title_heading',
                    'type'      => 'title',
                    'headding'  => esc_html__( 'Title', 'woolentor' ),
                    'size'      => 'woolentor_style_seperator',
                ),
                array(
                    'name'  => 'title_color',
                    'label' => __( 'Title color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#444444',
                ),
                array(
                    'name'  => 'title_hover_color',
                    'label' => __( 'Title hover color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#dc9a0e',
                ),

                array(
                    'name'      => 'section_price_heading',
                    'type'      => 'title',
                    'headding'  => esc_html__( 'Price', 'woolentor' ),
                    'size'      => 'woolentor_style_seperator',
                ),
                array(
                    'name'  => 'sale_price_color',
                    'label' => __( 'Sale price color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#444444',
                ),
                array(
                    'name'  => 'regular_price_color',
                    'label' => __( 'Regular price color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#444444',
                ),

                array(
                    'name'      => 'section_category_heading',
                    'type'      => 'title',
                    'headding'  => esc_html__( 'Category', 'woolentor' ),
                    'size'      => 'woolentor_style_seperator',
                ),
                array(
                    'name'  => 'category_color',
                    'label' => __( 'Category color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#444444',
                ),
                array(
                    'name'  => 'category_hover_color',
                    'label' => __( 'Category hover color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#dc9a0e',
                ),

                array(
                    'name'      => 'section_short_description_heading',
                    'type'      => 'title',
                    'headding'  => esc_html__( 'Short Description', 'woolentor' ),
                    'size'      => 'woolentor_style_seperator',
                ),
                array(
                    'name'  => 'desc_color',
                    'label' => __( 'Description color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#444444',
                ),

                array(
                    'name'      => 'section_rating_heading',
                    'type'      => 'title',
                    'headding'  => esc_html__( 'Rating', 'woolentor' ),
                    'size'      => 'woolentor_style_seperator',
                ),
                array(
                    'name'  => 'empty_rating_color',
                    'label' => __( 'Empty rating color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#aaaaaa',
                ),
                array(
                    'name'  => 'rating_color',
                    'label' => __( 'Rating color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#dc9a0e',
                ),

                array(
                    'name'      => 'section_badge_heading',
                    'type'      => 'title',
                    'headding'  => esc_html__( 'Product Badge', 'woolentor' ),
                    'size'      => 'woolentor_style_seperator',
                ),
                array(
                    'name'  => 'badge_color',
                    'label' => __( 'Badge color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#444444',
                ),

                array(
                    'name'      => 'section_action_btn_heading',
                    'type'      => 'title',
                    'headding'  => esc_html__( 'Quick Action Button', 'woolentor' ),
                    'size'      => 'woolentor_style_seperator',
                ),
                array(
                    'name'  => 'tooltip_color',
                    'label' => __( 'Tool tip color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#ffffff',
                ),
                array(
                    'name'  => 'btn_color',
                    'label' => __( 'Button color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#000000',
                ),
                array(
                    'name'  => 'btn_hover_color',
                    'label' => __( 'Button hover color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#dc9a0e',
                ),

                array(
                    'name'      => 'section_action_list_btn_heading',
                    'type'      => 'title',
                    'headding'  => esc_html__( 'Archive List View Action Button', 'woolentor' ),
                    'size'      => 'woolentor_style_seperator',
                ),
                array(
                    'name'  => 'list_btn_color',
                    'label' => __( 'List View Button color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#000000',
                ),
                array(
                    'name'  => 'list_btn_hover_color',
                    'label' => __( 'List View Button Hover color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#dc9a0e',
                ),
                array(
                    'name'  => 'list_btn_bg_color',
                    'label' => __( 'List View Button background color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#ffffff',
                ),
                array(
                    'name'  => 'list_btn_hover_bg_color',
                    'label' => __( 'List View Button hover background color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#ff3535',
                ),

                array(
                    'name'      => 'section_counter_timer_heading',
                    'type'      => 'title',
                    'headding'  => esc_html__( 'Counter Timer', 'woolentor' ),
                    'size'      => 'woolentor_style_seperator',
                ),
                array(
                    'name'  => 'counter_color',
                    'label' => __( 'Counter timer color', 'woolentor' ),
                    'desc' => wp_kses_post( 'Default Color for universal layout.', 'woolentor' ),
                    'type' => 'color',
                    'default'=>'#ffffff',
                ),

            ),

            'woolentor_buy_pro_tabs' => array(),

        );

        // Post Duplicator Condition
        if( !is_plugin_active('ht-mega-for-elementor/htmega_addons_elementor.php') ){
            $settings_fields['woolentor_others_tabs'][] = [
                'name'  => 'postduplicator',
                'label'  => esc_html__( 'Post Duplicator', 'woolentor-pro' ),
                'type'  => 'checkbox',
                'default'=>'off',
                'class'=>'woolentor_table_row',
            ];

            if( woolentor_get_option( 'postduplicator', 'woolentor_others_tabs', 'off' ) === 'on' ){
                $post_types = woolentor_get_post_types( array('defaultadd'=>'all') );
                if ( did_action( 'elementor/loaded' ) && defined( 'ELEMENTOR_VERSION' ) ) {
                    $post_types['elementor_library'] = esc_html__( 'Templates', 'woolentor' );
                }
                $settings_fields['woolentor_others_tabs'][] = [
                    'name'    => 'postduplicate_condition',
                    'label'   => __( 'Post Duplicator Condition', 'woolentor' ),
                    'desc'    => __( 'You can enable duplicator for individual post.', 'woolentor' ),
                    'type'    => 'multiselect',
                    'default' => '',
                    'options' => $post_types,
                ];
            }
        }

        // Wishsuite Addons
        if( is_plugin_active('wishsuite/wishsuite.php') ){
            $settings_fields['woolentor_elements_tabs'][] = [
                'name'   => 'wb_wishsuite_table',
                'label'  => __( 'WishSuite Table', 'woolentor' ),
                'type'   => 'checkbox',
                'default' => 'on',
                'class'   => 'woolentor_table_row',
            ];
        }

        // Ever Compare Addons
        if( is_plugin_active('ever-compare/ever-compare.php') ){
            $settings_fields['woolentor_elements_tabs'][] = [
                'name'   => 'wb_ever_compare_table',
                'label'  => __( 'Ever Compare', 'woolentor' ),
                'type'   => 'checkbox',
                'default' => 'on',
                'class'   => 'woolentor_table_row',
            ];
        }

        // JustTable Addons
        if( is_plugin_active('just-tables/just-tables.php') || is_plugin_active('just-tables-pro/just-tables-pro.php') ){
            $settings_fields['woolentor_elements_tabs'][] = [
                'name'   => 'wb_just_table',
                'label'  => __( 'JustTable', 'woolentor' ),
                'type'   => 'checkbox',
                'default' => 'on',
                'class'   => 'woolentor_table_row',
            ];
        }

        // whols Addons
        if( is_plugin_active('whols/whols.php') || is_plugin_active('whols-pro/whols-pro.php') ){
            $settings_fields['woolentor_elements_tabs'][] = [
                'name'   => 'wb_whols',
                'label'  => __( 'Whols', 'woolentor' ),
                'type'   => 'checkbox',
                'default' => 'on',
                'class'   => 'woolentor_table_row',
            ];
        }

        // Multicurrency Addons
        if( is_plugin_active('wc-multi-currency/wcmilticurrency.php') || is_plugin_active('multicurrencypro/multicurrencypro.php') ){
            $settings_fields['woolentor_elements_tabs'][] = [
                'name'   => 'wb_wc_multicurrency',
                'label'  => __( 'Multi Currency', 'woolentor' ),
                'type'   => 'checkbox',
                'default' => 'on',
                'class'   => 'woolentor_table_row',
            ];
        }
        
        return array_merge( $settings_fields );
    }


    function plugin_page() {

        echo '<div class="wrap woolentor-setting-area">';

            echo '<div class="htoptions-area">';
                echo '<h2>'.esc_html__( 'WooLentor Settings','woolentor' ).'</h2>';
                $this->save_message();
                $this->settings_api->show_navigation();
                $this->settings_api->show_forms();
            echo '</div>';

            $side_banner_html = $this->sidebar_add_banner_html();
            echo apply_filters( 'woolentor_sidebar_adds_banner', $side_banner_html );

        echo '</div>';

    }

    function save_message() {
        if( isset($_GET['settings-updated']) ) { ?>
            <div class="updated notice is-dismissible"> 
                <p><strong><?php esc_html_e('Successfully Settings Saved.', 'woolentor') ?></strong></p>
            </div>
            <?php
        }
    }

    /**
     * [sidebar_add_banner_html] Pro add sidebar banner
     * @return [void]
     */
    function sidebar_add_banner_html(){

        ob_start();
        ?>
        <div class="htoptions-sidebar-adds-area">

            <div class="htoption-banner-area">
                <div class="htoption-banner-head">
                    <div class="htoption-logo">
                        <img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/logo.png" alt="<?php echo esc_attr__( 'WooLentor', 'woolentor' ); ?>">
                    </div>
                    <div class="htoption-intro">
                        <p><?php echo wp_kses_post( 'WooLentor is one of the most popular WooCommerce Elementor Addons on WordPress.org. It has been downloaded more than 528,763 times and 50,000 stores are using WooLentor plugin. Why not you?' ); ?></p>
                    </div>
                </div>

                <ul class="htoption-feature">
                    <li><?php echo esc_html__( '76 Elementor Elements', 'woolentor' ); ?></li>
                    <li><?php echo esc_html__( '15 Product Custom Templates', 'woolentor' ); ?></li>
                    <li><?php echo esc_html__( '10 Custom Shop Page Templates', 'woolentor' ); ?></li>
                    <li><?php echo esc_html__( 'Cart Page, Checkout, My Account, Registration and Thank you page custom layout template', 'woolentor' ); ?></li>
                    <li><?php echo esc_html__( '5 Premium WooCommerce Themes included. (Save $200)', 'woolentor' ); ?></li>
                </ul>

                <div class="htoption-action-btn">
                    <a class="htoption-btn" href="<?php echo esc_url( 'https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/?db' ); ?>" target="_blank">
                        <span class="htoption-btn-text"><?php echo esc_html__( 'Get Pro Now', 'woolentor' ); ?></span>
                        <span class="htoption-btn-icon"><img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/icon/plus.png" alt="<?php echo esc_attr__( 'Get pro now', 'woolentor' ); ?>"></span>
                    </a>
                </div>
            </div>

            <div class="htoption-rating-area">
                <div class="htoption-rating-icon">
                    <img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/icon/rating.png" alt="<?php echo esc_attr__( 'Rating icon', 'woolentor' ); ?>">
                </div>
                <div class="htoption-rating-intro">
                    <?php echo esc_html__('If you’re loving how our product has helped your business, please let the WordPress community know by','woolentor'); ?> <a target="_blank" href="https://wordpress.org/support/plugin/woolentor-addons/reviews/?filter=5#new-post"><?php echo esc_html__( 'leaving us a review on our WP repository', 'woolentor' ); ?></a>. <?php echo esc_html__( 'Which will motivate us a lot.', 'woolentor' ); ?>
                </div>
            </div>

        </div>
        <?php
        return ob_get_clean();

    }

    // Custom Markup
    
    // HTML Style tab Section
    function style_tab_html(){
        ob_start();
        ?>
        <div class="woolentor-style-tab-title">
            <h3><?php esc_html_e( 'Universal layout style options', 'woolentor-pro' );?></h3>
        </div>
        <?php
        echo ob_get_clean();
    }
    
    // HTML Style tab bottom Section
    function style_tab_bottom_html(){
        ob_start();
        ?>
        <div class="woolentor-style-tab-bottom">
            <h3><?php echo esc_html__( 'Helping Screenshot:', 'woolentor' ); ?></h3>
            <img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/universal-layout-screen.png" alt="<?php echo esc_attr__( 'Universal layout', 'woolentor' ); ?>">
        </div>
        <?php
        echo ob_get_clean();
    }

    // General tab
    function woolentor_html_general_tabs(){
        ob_start();
        ?>
            <div class="woolentor-general-tabs">

                <div class="woolentor-document-section">
                    <div class="woolentor-column">
                        <a href="https://www.youtube.com/watch?v=_MOgvsZJ6uA&list=PLk25BQFrj7wH9zCECMNCtEvvUKkpV5TYA" target="_blank">
                            <img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/video-tutorial.jpg" alt="<?php esc_attr_e( 'Video Tutorial', 'woolentor' ); ?>">
                        </a>
                    </div>
                    <div class="woolentor-column">
                        <a href="https://demo.hasthemes.com/doc/woolentor/index.html" target="_blank">
                            <img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/online-documentation.jpg" alt="<?php esc_attr_e( 'Online Documentation', 'woolentor' ); ?>">
                        </a>
                    </div>
                    <div class="woolentor-column">
                        <a href="https://hasthemes.com/contact-us/" target="_blank">
                            <img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/genral-contact-us.jpg" alt="<?php esc_attr_e( 'Contact Us', 'woolentor' ); ?>">
                        </a>
                    </div>
                </div>

                <div class="different-pro-free">
                    <h3 class="wooolentor-section-title"><?php echo esc_html__( 'WooLentor Free VS WooLentor Pro.', 'woolentor' ); ?></h3>

                    <div class="woolentor-admin-row">
                        <div class="features-list-area">
                            <h3><?php echo esc_html__( 'WooLentor Free', 'woolentor' ); ?></h3>
                            <ul>
                                <li><?php echo esc_html__( '18 Elements', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'Shop Page Builder ( Default Layout )', 'woolentor' ); ?></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Shop Page Builder ( Custom Design )', 'woolentor' ); ?></del></li>
                                <li><?php echo esc_html__( '3 Product Custom Layout', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'Single Product Template Builder', 'woolentor' ); ?></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Single Product Individual Layout', 'woolentor' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Product Archive Category Wise Individual layout', 'woolentor' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Cart Page Builder', 'woolentor' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Checkout Page Builder', 'woolentor' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'Thank You Page Builder', 'woolentor' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'My Account Page Builder', 'woolentor' ); ?></del></li>
                                <li class="wldel"><del><?php echo esc_html__( 'My Account Login page Builder', 'woolentor' ); ?></del></li>
                            </ul>
                            <a class="button button-primary" href="<?php echo esc_url( admin_url() ); ?>plugin-install.php?s=woolentor-addons&tab=search&type=term" target="_blank"><?php echo esc_html__( 'Install Now', 'woolenror' ); ?></a>
                        </div>
                        <div class="features-list-area">
                            <h3><?php echo esc_html__( 'WooLentor Pro', 'woolentor' ); ?></h3>
                            <ul>
                                <li><?php echo esc_html__( '41 Elements', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'Shop Page Builder ( Default Layout )', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'Shop Page Builder ( Custom Design )', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( '15 Product Custom Layout', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'Single Product Template Builder', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'Single Product Individual Layout', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'Product Archive Category Wise Individual layout', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'Cart Page Builder', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'Checkout Page Builder', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'Thank You Page Builder', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'My Account Page Builder', 'woolentor' ); ?></li>
                                <li><?php echo esc_html__( 'My Account Login page Builder', 'woolentor' ); ?></li>
                            </ul>
                            <a class="button button-primary" href="https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/?db" target="_blank"><?php echo esc_html__( 'Buy Now', 'woolenror' ); ?></a>
                        </div>
                    </div>

                </div>

            </div>
        <?php
        echo ob_get_clean();
    }

    // Pop up Box
    function woolentor_html_popup_box(){
        ob_start();
        ?>
            <div id="woolentor-dialog" title="<?php esc_html_e( 'Go Premium', 'woolentor' ); ?>" style="display: none;">
                <div class="wldialog-content">
                    <span><i class="dashicons dashicons-warning"></i></span>
                    <p>
                        <?php
                            echo __('Purchase our','woolentor').' <strong><a href="'.esc_url( 'https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/?db' ).'" target="_blank" rel="nofollow">'.__( 'premium version', 'woolentor' ).'</a></strong> '.__('to unlock these pro elements!','woolentor');
                        ?>
                    </p>
                </div>
            </div>

            <script>
                ( function( $ ) {
                    
                    $(function() {
                        $( '.woolentor_table_row.pro,.proelement label' ).click(function() {
                            $( "#woolentor-dialog" ).dialog({
                                modal: true,
                                minWidth: 500,
                                buttons: {
                                    Ok: function() {
                                      $( this ).dialog( "close" );
                                    }
                                }
                            });
                        });
                        $(".woolentor_table_row.pro input[type='checkbox'],.proelement select,.proelement input[type='text'],.proelement input[type='radio']").attr("disabled", true);
                    });

                } )( jQuery );
            </script>
        <?php
        echo ob_get_clean();
    }

    // Theme Library
    function woolentor_html_themes_library_tabs() {
        ob_start();
        ?>
        <div class="woolentor-themes-laibrary">
            <p><?php echo esc_html__( 'Use Our WooCommerce Theme for your online Store.', 'woolentor' ); ?></p>
            <div class="woolentor-themes-area">
                <div class="woolentor-themes-row">

                    <div class="woolentor-single-theme"><img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/99fy.png" alt="">
                        <div class="woolentor-theme-content">
                            <h3><?php echo esc_html__( '99Fy - Free', 'woolentor' ); ?></h3>
                            <p><?php echo esc_html__( '99fy is a free WooCommerce theme. 99 demos for 24 niche categories are included in this theme.', 'woolentor' ); ?></p>
                            <a href="https://demo.hasthemes.com/99fy-preview/index.html" class="woolentor-button" target="_blank"><?php echo esc_html__( 'Preview', 'woolentor' ); ?></a>
                            <a href="https://hasthemes.com/download-99fy" class="woolentor-button"><?php echo esc_html__( 'Download', 'woolentor' ); ?></a>
                        </div>
                    </div>

                    <div class="woolentor-single-theme"><img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/parlo.png" alt="">
                        <div class="woolentor-theme-content">
                            <h3><?php echo esc_html__( 'Parlo - Free', 'woolentor' ); ?></h3>
                            <p><?php echo esc_html__( 'Parlo is a free WooCommerce theme developed by our team. You can use this for your store.', 'woolentor' );?></p>
                            <a href="http://demo.hasthemes.com/wp/parlo-preview.html" class="woolentor-button" target="_blank"><?php echo esc_html__( 'Preview', 'woolentor' ); ?></a>
                            <a href="https://freethemescloud.com/item/parlo-free-woocommerce-theme/" class="woolentor-button"><?php echo esc_html__( 'Download', 'woolentor' ); ?></a>
                        </div>
                    </div>

                    <div class="woolentor-single-theme"><img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/99fy-pro.png" alt="">
                        <div class="woolentor-theme-content">
                            <h3><?php echo esc_html__( '99Fy Pro - included in WooLentor Pro', 'woolentor' ); ?> <span><?php echo esc_html__( '( Pro )', 'woolentor' ); ?></span></h3>
                            <p><?php echo esc_html__( 'Pro version of 99fy is included in WooLentor pro. It will save money for the WooLentor pro users.', 'woolentor' ); ?></p>
                            <a href="https://demo.hasthemes.com/99fy-preview/index.html" class="woolentor-button" target="_blank"><?php echo esc_html__( 'Preview', 'woolentor' ); ?></a>
                        </div>
                    </div>

                    <div class="woolentor-single-theme"><img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/flone.png" alt="">
                        <div class="woolentor-theme-content">
                            <h3><?php echo esc_html__( 'Flone - included in WooLentor Pro', 'woolentor' ); ?> <span><?php echo esc_html__( '( Pro )', 'woolentor' ); ?></span></h3>
                            <p><?php echo esc_html__( 'Flone is one of our most popular WooComemrce Themes using by 1000+ stores.', 'wooLentor' );?></p>
                            <a href="https://demo.hasthemes.com/flone-woo-preview/index.html" class="woolentor-button" target="_blank"><?php echo esc_html__( 'Preview', 'woolentor' ); ?></a>
                        </div>
                    </div>

                    <div class="woolentor-single-theme"><img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/parlo.png" alt="">
                        <div class="woolentor-theme-content">
                            <h3><?php echo esc_html__( 'Parlo Pro - included in WooLentor Pro', 'woolentor' ); ?> <span><?php echo esc_html__( '( Pro )', 'woolentor' ); ?></span></h3>
                            <p><?php echo esc_html__( 'Pro version of Parlo is included in WooLentor pro. It will save money for the WooLentor pro users.', 'wooLentor' );?></p>
                            <a href="http://demo.hasthemes.com/wp/parlo-preview.html" class="woolentor-button" target="_blank"><?php echo esc_html__( 'Preview', 'woolentor' ); ?></a>
                        </div>
                    </div>

                    <div class="woolentor-single-theme"><img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/holmes.png" alt="">
                        <div class="woolentor-theme-content">
                            <h3><?php echo esc_html__( 'Holmes - included in WooLentor Pro', 'woolentor' ); ?> <span><?php echo esc_html__( '( Pro )', 'woolentor' ); ?></span></h3>
                            <p><?php echo esc_html__( 'Holmes is a preimum woocommerce theme included in WooLentor pro. It will save money for the WooLentor pro users.', 'woolentor' );?></p>
                            <a href="http://demo.hasthemes.com/wp/holmes-preview.html" class="woolentor-button" target="_blank"><?php echo esc_html__( 'Preview', 'woolentor' ); ?></a>
                        </div>
                    </div>
                    
                    <div class="woolentor-single-theme"><img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/daniel-home-1.png" alt="">
                        <div class="woolentor-theme-content">
                            <h3><?php echo esc_html__( 'Daniel - included in WooLentor Pro', 'woolentor' ); ?> <span><?php echo esc_html__( '( Pro )', 'woolentor' ); ?></span></h3>
                            <p><?php echo esc_html__( 'Daniel is a preimum woocommerce theme included in WooLentor pro. It will save money for the WooLentor pro users.', 'woolentor' ); ?></p>
                            <a href="http://demo.hasthemes.com/wp/daniel-preview.html" class="woolentor-button" target="_blank"><?php echo esc_html__( 'Preview', 'woolentor' ); ?></a>
                        </div>
                    </div>
                    
                    <div class="woolentor-single-theme"><img src="<?php echo WOOLENTOR_ADDONS_PL_URL; ?>/includes/admin/assets/images/hurst-home-1.png" alt="">
                        <div class="woolentor-theme-content">
                            <h3><?php echo esc_html__( 'Hurst - included in WooLentor Pro', 'woolentor' ); ?> <span><?php echo esc_html__( '( Pro )', 'woolentor' ); ?></span></h3>
                            <p><?php echo esc_html__( 'Hurst is a preimum woocommerce theme included in WooLentor pro. It will save money for the WooLentor pro users.', 'woolentor' ); ?></p>
                            <a href="http://demo.hasthemes.com/wp/hurst-preview.html" class="woolentor-button" target="_blank"><?php echo esc_html__( 'Preview', 'woolentor' ); ?></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
        echo ob_get_clean();
    }

    // Buy Pro
    function woolentor_html_buy_pro_tabs(){
        ob_start();
        ?>
            <div class="woolentor-admin-tab-area">
                <ul class="woolentor-admin-tabs">
                    <li><a href="#oneyear"><?php echo esc_html__( 'One Year', 'woolentor' ); ?></a></li>
                    <li><a href="#lifetime" class="wlactive"><?php echo esc_html__( 'Life Time', 'woolentor' ); ?></a></li>
                </ul>
            </div>
            
            <div id="oneyear" class="woolentor-admin-tab-pane">
                <div class="woolentor-admin-row">

                    <div class="woolentor-price-plan">
                        <a href="https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/?db" target="_blank"><img src="https://woolentor.com/pricing/admin-add/one_year_single_website.png" alt="<?php echo esc_attr__( 'One Year Single Website','woolentor' );?>"></a>
                    </div>

                    <div class="woolentor-price-plan">
                        <a href="https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/?db" target="_blank"><img src="https://woolentor.com/pricing/admin-add/one_year_five_website.png" alt="<?php echo esc_attr__( 'One Year Unlimited Website','woolentor' );?>"></a>
                    </div>

                    <div class="woolentor-price-plan">
                        <a href="https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/?db" target="_blank"><img src="https://woolentor.com/pricing/admin-add/one_year_agency.png" alt="<?php echo esc_attr__( 'One Year Unlimited Websites','woolentor' );?>"></a>
                    </div>

                </div>
            </div>

            <div id="lifetime" class="woolentor-admin-tab-pane wlactive">
                
                <div class="woolentor-admin-row">
                    <div class="woolentor-price-plan">
                        <a href="https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/?db" target="_blank"><img src="https://woolentor.com/pricing/admin-add/life_time_single_website.png" alt="<?php echo esc_attr__( 'Life Time Single Website','woolentor' );?>"></a>
                    </div>

                    <div class="woolentor-price-plan">
                        <a href="https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/?db" target="_blank"><img src="https://woolentor.com/pricing/admin-add/life_time_five_website.png" alt="<?php echo esc_attr__( 'Life time Unlimited Website','woolentor' );?>"></a>
                    </div>

                    <div class="woolentor-price-plan">
                        <a href="https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/?db" target="_blank"><img src="https://woolentor.com/pricing/admin-add/life_time_agency.png" alt="<?php echo esc_attr__( 'Life Time Unlimited Websites','woolentor' );?>"></a>
                    </div>
                </div>

            </div>

        <?php
        echo ob_get_clean();
    }
    

}

new Woolentor_Admin_Settings();