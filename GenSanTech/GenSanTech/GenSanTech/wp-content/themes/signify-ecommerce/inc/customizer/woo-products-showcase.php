<?php
/**
 * Adding support for WooCommerce Products Showcase Option
 */

/**
 * Add WooCommerce Product Showcase Options to customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_woo_products_showcase( $wp_customize ) {
   $wp_customize->add_section( 'signify_woo_products_showcase', array(
        'title' => esc_html__( 'WooCommerce Products Showcase', 'signify-ecommerce' ),
        'panel' => 'signify_theme_options',
    ) );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_woo_products_showcase_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'signify_sanitize_select',
            'choices'           => signify_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'signify-ecommerce' ),
            'section'           => 'signify_woo_products_showcase',
            'type'              => 'select',
        )
    );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_woo_products_showcase_bg_image',
            'sanitize_callback' => 'signify_sanitize_image',
            'active_callback'   => 'signify_is_woo_products_showcase_active',
            'custom_control'    => 'WP_Customize_Image_Control',
            'label'             => esc_html__( 'Background Image', 'signify-ecommerce' ),
            'section'           => 'signify_woo_products_showcase',
        )
    );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_woo_products_showcase_headline',
            'default'           => esc_html__( 'Exclusive Merch', 'signify-ecommerce' ),
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Headline', 'signify-ecommerce' ),
            'active_callback'   => 'signify_is_woo_products_showcase_active',
            'section'           => 'signify_woo_products_showcase',
            'type'              => 'text',
        )
    );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_woo_products_showcase_subheadline',
            'sanitize_callback' => 'wp_kses_post',
            'label'             => esc_html__( 'Sub headline', 'signify-ecommerce' ),
            'active_callback'   => 'signify_is_woo_products_showcase_active',
            'section'           => 'signify_woo_products_showcase',
            'type'              => 'text',
        )
    );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_woo_products_showcase_number',
            'default'           => 8,
            'sanitize_callback' => 'signify_sanitize_number_range',
            'active_callback'   => 'signify_is_woo_products_showcase_active',
            'description'       => esc_html__( 'Save and refresh the page if No. of Products is changed. Set -1 to display all', 'signify-ecommerce' ),
            'input_attrs'       => array(
                'style' => 'width: 50px;',
                'min'   => -1,
            ),
            'label'             => esc_html__( 'No of Products', 'signify-ecommerce' ),
            'section'           => 'signify_woo_products_showcase',
            'type'              => 'number',
        )
    );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_woo_products_showcase_text',
            'default'           => esc_html__( 'Go to Shop Page', 'signify-ecommerce' ),
            'sanitize_callback' => 'sanitize_text_field',
            'active_callback'   => 'signify_is_woo_products_showcase_active',
            'label'             => esc_html__( 'Button Text', 'signify-ecommerce' ),
            'section'           => 'signify_woo_products_showcase',
            'type'              => 'text',
        )
    );

    $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
    signify_register_option( $wp_customize, array(
            'name'              => 'signify_woo_products_showcase_link',
            'default'           =>  esc_url( $shop_page_url ),
            'sanitize_callback' => 'esc_url_raw',
            'active_callback'   => 'signify_is_woo_products_showcase_active',
            'label'             => esc_html__( 'Button Link', 'signify-ecommerce' ),
            'section'           => 'signify_woo_products_showcase',
        )
    );

    signify_register_option( $wp_customize, array(
            'name'              => 'signify_woo_products_showcase_target',
            'sanitize_callback' => 'signify_sanitize_checkbox',
            'active_callback'   => 'signify_is_woo_products_showcase_active',
            'label'             => esc_html__( 'Open Link in New Window/Tab', 'signify-ecommerce' ),
            'section'           => 'signify_woo_products_showcase',
            'type'              => 'checkbox',
        )
    );
}
add_action( 'customize_register', 'signify_woo_products_showcase', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'signify_is_woo_products_showcase_active' ) ) :
    /**
    * Return true if featured content is active
    *
    * @since 1.0.0
    */
    function signify_is_woo_products_showcase_active( $control ) {
        $enable = $control->manager->get_setting( 'signify_woo_products_showcase_option' )->value();

        return signify_check_section( $enable );
    }
endif;
