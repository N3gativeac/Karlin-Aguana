<?php
/**
 * Recommended plugins
 *
 * @package techup
 */

if ( ! function_exists( 'techup_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function techup_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'techup' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
			array(
                'name'     => esc_html__( 'Image Slider', 'techup' ),
                'slug'     => 'image-slider-slideshow',
                'required' => false,
            )
        );
		 
		 
        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'techup_recommended_plugins' );