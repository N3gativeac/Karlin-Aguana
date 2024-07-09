<?php
/**
* Add theme options related to this child theme
*
* @package Signify_eCommerce
*/

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_ecommerce_theme_options( $wp_customize ) {
	// Header Top Options
	$wp_customize->add_section( 'signify_header_top', array(
		'panel'       => 'signify_theme_options',
		'title'       => esc_html__( 'Header Top Options', 'signify-ecommerce' ),
	) );

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_display_header_top',
			'sanitize_callback' => 'signify_sanitize_checkbox',
			'label'             => esc_html__( 'Header Top', 'signify-ecommerce' ),
			'section'           => 'signify_header_top',
			'type'    			=> 'checkbox',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_display_header_search',
			'sanitize_callback' => 'signify_sanitize_checkbox',
			'active_callback'   => 'signify_is_header_top_enabled',
			'label'             => esc_html__( 'Search', 'signify-ecommerce' ),
			'section'           => 'signify_header_top',
			'type'    			=> 'checkbox',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_display_date',
			'sanitize_callback' => 'signify_sanitize_checkbox',
			'active_callback'   => 'signify_is_header_top_enabled',
			'label'             => esc_html__( 'Display Date', 'signify-ecommerce' ),
			'section'           => 'signify_header_top',
			'type'    			=> 'checkbox',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_email_label',
			'default'           => 	esc_html__( 'Email Us:', 'signify-ecommerce' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'signify_is_header_top_enabled',
			'label'             => esc_html__( 'Email Label', 'signify-ecommerce' ),
			'section'           => 'signify_header_top',
			'type'              => 'text',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_email',
			'sanitize_callback' => 'sanitize_email',
			'active_callback'   => 'signify_is_header_top_enabled',
			'label'             => esc_html__( 'Email', 'signify-ecommerce' ),
			'section'           => 'signify_header_top',
			'type'              => 'text',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_phone_label',
			'default'           => 	esc_html__( 'Call Us:', 'signify-ecommerce' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'signify_is_header_top_enabled',
			'label'             => esc_html__( 'Phone Label', 'signify-ecommerce' ),
			'section'           => 'signify_header_top',
			'type'              => 'text',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_phone',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'signify_is_header_top_enabled',
			'label'             => esc_html__( 'Phone', 'signify-ecommerce' ),
			'section'           => 'signify_header_top',
			'type'              => 'text',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_address_label',
			'default'           => 	esc_html__( 'Address:', 'signify-ecommerce' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'signify_is_header_top_enabled',
			'label'             => esc_html__( 'Address Label', 'signify-ecommerce' ),
			'section'           => 'signify_header_top',
			'type'              => 'text',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_address',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback'   => 'signify_is_header_top_enabled',
			'label'             => esc_html__( 'Address', 'signify-ecommerce' ),
			'section'           => 'signify_header_top',
			'type'              => 'text',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_header_top_display_cart_link',
			'sanitize_callback' => 'signify_sanitize_checkbox',
			'active_callback'   => 'signify_is_header_top_enabled',
			'label'             => esc_html__( 'Display Cart Link', 'signify-ecommerce' ),
			'section'           => 'signify_header_top',
			'type'    			=> 'checkbox',
		)
	);
}
add_action( 'customize_register', 'signify_ecommerce_theme_options', 10 );

/** Active Callbacks **/
if ( ! function_exists( 'signify_is_header_top_enabled' ) ) :
	/**
	* Return true if events is active
	*
	* @since  Signify Pro 1.0
	*/
	function signify_is_header_top_enabled( $control ) {
		return ( $control->manager->get_setting( 'signify_display_header_top' )->value() );
	}
endif;
